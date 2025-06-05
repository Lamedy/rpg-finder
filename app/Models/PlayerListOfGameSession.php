<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerListOfGameSession extends Model
{
    protected $table = 'player_list_of_game_session';
    protected $primaryKey = 'player_list_of_game_session_pk';
    public $timestamps = false;
    protected $fillable = ['player_list_of_game_session_pk', 'user_pk', 'game_session_pk', 'invite_status', 'notice_for_author', 'notice_for_user'];

    public function gameSession()
    {
        return $this->belongsTo(GameSession::class, 'game_session_pk', 'game_session_pk');
    }
}
