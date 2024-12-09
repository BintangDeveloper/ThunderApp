<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RedirectLinks extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'key',
        'url',
        'permission'
    ];
}
