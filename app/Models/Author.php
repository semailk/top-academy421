<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $father_name
 * @property string $birth_date
 * @property string $biography
 * @property bool $gender
 * @property integer $active
 * @property string $created_at
 * @property string $updated_at
 */
class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'birth_date',
        'biography',
        'gender',
        'active',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'created_at' => 'datetime',
    ];

    public function book(): HasOne
    {
        return $this->hasOne(Book::class);
    }
}
