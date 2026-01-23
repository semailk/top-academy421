<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $description
 * @property string $created_date
 * @property int $author_id
 * @property int $company_id
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author_id',
        'description',
        'created_date',
        'company_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getNameAttribute(): string
    {
        return mb_strtolower($this->attributes['name']);
    }

    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = mb_strtoupper($value);
    }
}
