<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
 * Таблица хранит список всех игровых систем для анкеты
*/
class GameSessionSystemList extends Model
{
    protected $table = 'game_session_system_list';

    protected $fillable = ['game_session_pk', 'game_system_pk'];

    public $timestamps = false;
}
