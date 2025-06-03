<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Halqa extends Model
{
    use HasFactory;

    protected $primaryKey = 'halqa_id';
    protected $table = 'halqa';

    protected $fillable = [
        'halqa_name',
        'tehsil_id',
    ];

    public function tehsil()
    {
        return $this->belongsTo(Tehsil::class, 'tehsil_id', 'tehsil_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    public function division()
    {
        return $this->belongsTo(Divsion::class, 'id');
    }
}
