<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\UserInfo
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $address
 * @property int $city_id
 * @property string $phone
 * @property string $passport_code
 * @property-read City $city
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo wherePassportCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereUserId($value)
 * @mixin Eloquent
 * @property string $library_card
 * @method static \Illuminate\Database\Eloquent\Builder|UserInfo whereLibraryCard($value)
 */
class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'user_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address',
        'city_id',
        'phone',
        'passport_code',
    ];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
