<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * @method static \App\Models\User create(array $attributes)
 * @property int $user_pk
 * @property string|null $name
 * @property bool|null $gender
 * @property string|null $birthdate
 */
class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'user_pk';

    protected $fillable = ['user_name', 'user_gender', 'birthdate'];

    public $incrementing = true;
    public $timestamps = false;

    public function auth(): HasOne
    {
        return $this->hasOne(UserAuthorization::class);
    }

    public static function getValueShowContactsOther($user_id): bool {
        return (bool) self::where('user_pk', $user_id)->value('show_contacts_others');
    }
}
