<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irrigator extends Model
{
    use HasFactory;
    public $primaryKey = 'id'; 
    public $table = 'irrigators'; 
    protected $fillable = [
        'village_id',
        'canal_id',
        'div_id',
        'irrigator_name', 
        'irrigator_khata_number', 
        'irrigator_f_name', 
        'irrigator_mobile_number', 
               'cnic', 

    ];

}
