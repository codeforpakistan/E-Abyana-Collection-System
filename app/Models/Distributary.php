<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributary extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'distributaries';

    protected $fillable = [
        'name',
        'canal_id',
        'minor_id',
        'div_id',
        'no_outlet',
        'no_outlet_ls',
        'no_outlet_rs',
        'total_no_cca',
        'total_no_discharge_cusic',
    ];
    public function canal()
    {
        return $this->belongsTo(Canal::class, 'canal_id', 'id');
    }
    public function division()
    {
        return $this->belongsTo(Divsion::class, 'div_id', 'id');
  
    }
    public function minor()
    {
        return $this->belongsTo(Minorcanal::class, 'minor_id', 'id');
    }
    
}

