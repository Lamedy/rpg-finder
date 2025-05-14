<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \App\Models\User create(array $attributes)
 */

class UserAuthorization extends Model
{
    protected $table = 'user_authorization';
    protected $primaryKey = 'user_pk';

    protected $fillable = ['user_pk', 'login', 'email', 'password'];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
