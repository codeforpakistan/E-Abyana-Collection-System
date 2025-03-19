<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignRoles extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'assign_roles';
    protected $fillable = [
        
       
        'role_id',
        'permission_id',
    ];
    
    /**
     * Get the outlet that this crop belongs to.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    /**
     * Get the village that this crop belongs to.
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}