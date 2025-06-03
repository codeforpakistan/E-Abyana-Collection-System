<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;
    public $primaryKey='farmer_id';
    public $table='farmers';
    protected $fillable = [
        'serial_number', 
        'registration_date',
         'assessment_number', 
         'patwari_name', 
         'owner_name',
        'tenant_name', 
        'cultivators_info', 
        'marla', 'kanal', 
        'previous_crop', 
        'snowing_date',
        'village_id', 
        'division_id', 
        'tehsil_id', 
        'district_id', 
        'canal_id', 
        'crop_id', 
        'outlet_id',
        'water_outlet', 
        'plat_boundary_number'
    ];

}
