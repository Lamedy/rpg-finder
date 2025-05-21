<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    protected $primaryKey = 'game_session_pk';

    protected $table = 'game_session';

    protected $fillable = [
        'game_session_pk', 'player_type_needed', 'player_count', 'game_format',
        'game_duration', 'game_description', 'game_place',
        'game_date', 'city_pk', 'price', 'contacts', 'author', 'created_at'
    ];
}
