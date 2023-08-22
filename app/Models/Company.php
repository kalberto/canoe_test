<?php

namespace App\Models;

use App\Traits\SaveToUpper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory, SaveToUpper;

    protected $fillable = [
        'name',
    ];

    public function funds(): BelongsToMany
    {
        return $this->belongsToMany(Fund::class, 'fund_company', 'company_id', 'fund_id');
    }
}
