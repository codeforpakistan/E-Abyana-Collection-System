<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'version_code',
        'version_name',
        'apk_url',
        'force_update',
    ];
}
