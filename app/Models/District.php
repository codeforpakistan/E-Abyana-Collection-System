<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public $primaryKey = 'id'; // Default primary key
    public $table = 'districts'; // Table name
    protected $fillable = [
        'name', // District name
        'div_id', // Foreign key to divisions

    ];
    public function tehsils()
    {
        return $this->hasMany(Tehsil::class, 'district_id');
    }
    public function division()
    {
        return $this->belongsTo(Divsion::class, 'div_id', 'id');
  
    }



}
