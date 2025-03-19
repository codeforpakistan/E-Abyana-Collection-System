<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tehsil extends Model
{
    use HasFactory;
    protected $primaryKey = 'tehsil_id'; // Set custom primary key
    protected $table = 'tehsils'; // Define the table name

    protected $fillable = [
        'tehsil_name',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    public function halqas()
    {
        return $this->hasMany(Halqa::class, 'tehsil_id', 'tehsil_id');
    }
}
