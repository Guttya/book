<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Cover
 *
 * @property-read Book $book
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|CoverType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoverType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoverType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|CoverType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoverType whereType($value)
 * @property-read int|null $book_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|CoverType whereName($value)
 */
class CoverType extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'cover_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
    ];

    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_cover');
    }

}
