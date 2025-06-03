<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class village extends Model
{
    use HasFactory;

    protected $primaryKey = 'village_id'; // Ensure this matches your table's primary key
    protected $table = 'villages'; // Ensure the table name is correct

    protected $fillable = [
        'village_name',
    
        'halqa_id',
        'tehsil_id',
    ];

   

    public function halqa()
    {
        return $this->belongsTo(Halqa::class, 'id');
    }
}

