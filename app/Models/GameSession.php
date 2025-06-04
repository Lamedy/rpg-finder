<?php

namespace App\Models;

use App\Enums\GameDuration;
use App\Enums\GameFormat;
use App\Enums\PlayerTypeNeeded;
use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    protected $primaryKey = 'game_session_pk';

    protected $table = 'game_session';

    protected $casts = [
        'game_format' => GameFormat::class,
        'game_duration' => GameDuration::class,
        'player_type_needed' => PlayerTypeNeeded::class,
    ];

    protected $fillable = [
        'game_session_pk', 'player_type_needed', 'player_count', 'game_format',
        'game_duration', 'game_description', 'game_place',
        'game_date', 'city_pk', 'price', 'contacts', 'author', 'created_at'
    ];

    public function gameSystems()
    {
        return $this->hasMany(GameSessionSystemList::class, 'game_session_pk', 'game_session_pk');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_pk', 'city_pk');
    }

    public function tags()
    {
        return $this->hasMany(SessionTagsList::class, 'game_session_pk', 'game_session_pk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'user_pk');
    }

    public function contacts()
    {
        return $this->hasMany(SessionContactsList::class, 'game_session_pk');
    }
}
