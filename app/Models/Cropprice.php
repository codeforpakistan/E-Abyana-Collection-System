<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cropprice extends Model
{
    use HasFactory;
    protected $fillable = [
        'crop_price',
        'final_crop',
    ];
}
