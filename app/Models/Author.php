<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use App\Observers\AuthorObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

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
 * @property int $user_id
 */
#[ObservedBy([AuthorObserver::class])]
class Author extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;
    protected $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'birth_date',
        'biography',
        'gender',
        'active',
        'user_id'
    ];

    public array $translatable = ['biography'];

    protected $casts = [
        'birth_date' => 'date',
        'created_at' => 'datetime',
    ];

    public function book(): HasOne
    {
        return $this->hasOne(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gender(): string
    {
        return $this->gender == 1 ? 'Male' : 'Female';
    }

    public function active(): string
    {
        return $this->active == 1 ? 'active' : 'deactive';
    }


    public function fio(): string
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->father_name;
    }
}
