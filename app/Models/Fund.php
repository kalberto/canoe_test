<?php

namespace App\Models;

use App\Traits\SaveToUpper;
use App\Traits\SaveWithSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fund extends Model
{
    use HasFactory, SaveToUpper, SaveWithSlug;

    protected $fillable = [
        'name',
        'slug',
        'start_year',
        'manager_id',
        'company_id',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(FundManager::class);
    }

    public function aliases(): HasMany
    {
        return $this->hasMany(Alias::class);
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'fund_company', 'fund_id', 'company_id');
    }

    protected function getAliasesAttribute(): array
    {
        return $this->aliases()->pluck('name')->toArray();
    }

    protected function setAliasesAttribute(array $aliases): void
    {
        $existingAlias = $this->aliases()->get();

        foreach ($existingAlias as $key => $alias) {
            if (isset($aliases[$key])) {
                $alias->name = $aliases[$key];
                unset($aliases[$key]);
            } else {
                $alias->delete();
            }
        }

        foreach ($aliases as $alias) {
            $this->aliases()->create([
                'name' => $alias,
            ]);
        }
    }
}
