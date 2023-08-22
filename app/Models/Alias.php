<?php

namespace App\Models;

use App\Traits\SaveToUpper;
use App\Traits\SaveWithSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alias extends Model
{
    use HasFactory, SaveToUpper, SaveWithSlug;

    protected $fillable = [
        'name',
        'slug',
        'fund_id',
    ];

    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }
}
