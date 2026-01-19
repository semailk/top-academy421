<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
