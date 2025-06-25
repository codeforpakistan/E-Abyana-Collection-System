<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'canals';

    protected $fillable = [
        'canal_name',
        'village_id',
        'c_type',
        'div_id',
        'no_outlet',
        'no_outlet_ls',
        'no_outlet_rs',
        'total_no_cca',
        'total_no_discharge_cusic',
    ];

    public function village()
    {
        return $this->belongsTo(village::class, 'village_id');
    }
    public function division()
    {
        return $this->belongsTo(Divsion::class, 'div_id', 'id');
  
    }
    public function minorCanals()
    {
        return $this->hasMany(Minorcanal::class, 'canal_id', 'id');
    }

    
}
