<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandRecord extends Model
{
    use HasFactory;
    public $primaryKey='crop_survey_id';
    public $table='cropsurveys';
    protected $fillable = [
        'khasra_number', 
        'tenant_name',
         'registration_date', 
         'cultivators_info', 
         'snowing_date',
         'session_date',
        'land_assessment_marla', 
        'land_assessment_kanal', 
        'previous_crop', 
        'date', 
        'width', 
        'length',

        'area_marla', 
        'area_kanal', 
        'final_crop', 
        'double_crop_marla',

        'double_crop_kanal', 
        'identifable_area_marla', 
        'identifable_area_kanal', 
        'irrigated_area_marla',
        'irrigated_area_kanal',
        'land_quality', 
        'crop_price', 
        'irrigator_khata_number', 
        'identifable_area_kanal', 
       
        'village_id', 
        'irrigator_id', 
      
        'canal_id', 
        'crop_id', 
        'outlet_id',
        'finalcrop_id',
        'crop_price',
        'is_billed',
        'review',
        'status',
        
    ];
}
