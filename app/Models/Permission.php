<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    public $primaryKey='id';
    public $table='permissions';
    protected $fillable = [
        'name',
    ];
}
