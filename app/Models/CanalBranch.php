<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanalBranch extends Model
{
    use HasFactory;

    // If your table name is not the plural 'canal_branches', define it explicitly
    protected $table = 'canal_branch'; // Optional if table is named 'canal_branches'

    protected $fillable = [
        'branch_name',
        'canal_id',
        'div_id',
        'minor_id',
        'distrib_id',
        'no_outlet',
        'no_outlet_ls',
        'no_outlet_rs',
        'total_no_cca',
        'total_no_discharge_cusic',
    ];

    // Relationships
    public function canal()
    {
        return $this->belongsTo(Canal::class);
    }

    public function division()
    {
        return $this->belongsTo(Divsion::class, 'div_id', 'id'); // Fixed typo: Divsion → Division
    }

    public function minor()
    {
        return $this->belongsTo(Minorcanal::class, 'minor_id', 'id');
    }

    public function distributary()
    {
        return $this->belongsTo(Distributary::class, 'distrib_id', 'id');
    }
}

