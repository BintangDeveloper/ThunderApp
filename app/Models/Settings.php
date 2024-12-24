<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Settings extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'key',
        'data',
        'permission',
        'can_expaired',
        'expaired',
        'create_by'
    ];
}
