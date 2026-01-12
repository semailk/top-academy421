<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $active
 */
class Role extends Model
{
    //
    protected $fillable = [
        'name',
        'active',
    ];
}
