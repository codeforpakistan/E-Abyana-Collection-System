<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Divsion extends Model
{
    public $primaryKey = 'id'; // Default primary key is 'id'
    public $table = 'divisions'; // Table name
    protected $fillable = [
        'divsion_name', // Column for the name of the division

    ];

    /**
     * Get the districts for the division.
     */
    public function districts()
    {
        return $this->hasMany(District::class, 'div_id', 'id'); 
        // 'div_id' is the foreign key in the districts table
        // 'id' is the local key in the divisions table
    }
}

