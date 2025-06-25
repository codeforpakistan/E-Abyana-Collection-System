<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceRevenue extends Model
{
    use HasFactory;
    protected $table = 'price_revenues';

    protected $fillable = [
        'crop_type',
        'flow',
        'LIS',
        't_well',
        'jhallar',
    ];
}
