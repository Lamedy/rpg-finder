<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \App\Models\User create(array $attributes)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 */

class UserAuthorization extends model implements CanResetPassword
{
    use CanResetPasswordTrait;

    protected $table = 'user_authorization';
    protected $primaryKey = 'user_pk';

    protected $fillable = ['user_pk', 'login', 'email', 'password'];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
