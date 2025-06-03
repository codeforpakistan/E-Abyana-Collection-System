<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $primaryKey='id';
    public $table='roles';
    protected $fillable = [
        'name',
    ];
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'assign_roles');
    }
}
