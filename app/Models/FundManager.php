<?php

namespace App\Models;

use App\Traits\SaveToUpper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundManager extends Model
{
    use HasFactory, SaveToUpper;

    protected $fillable = [
        'name',
    ];
}
