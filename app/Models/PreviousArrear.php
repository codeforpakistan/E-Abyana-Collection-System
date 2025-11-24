<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousArrear extends Model
{
    use HasFactory;

    protected $table = 'previous_arrears';

    protected $fillable = [
        'previous_arrears',
        'irrigator_id',
        'div_id',
    ];
}