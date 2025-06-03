<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'outlets';

    protected $fillable = [
        'outlet_name',
        'canal_id',
        'minor_id',
        'div_id',
        'distrib_id',
        'beneficiaries',
        'total_no_discharge_cusic',
        'total_no_cca',
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
    public function distributsry()
    {
        return $this->belongsTo(Distributary::class, 'distrib_id', 'id');
    }
}
