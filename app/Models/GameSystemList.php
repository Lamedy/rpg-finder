<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameSystemList extends Model
{
    protected $table = 'game_system_list';
    protected $primaryKey = 'game_system_list_pk';
    protected $fillable = ['game_system_list_pk', 'user_pk', 'game_system_pk', 'game_experience_pk'];
    public $timestamps = false;

    public function system()
    {
        return $this->belongsTo(GameSystems::class, 'game_system_pk', 'game_system_pk');
    }

    public function experience()
    {
        return $this->belongsTo(GameExperience::class, 'game_experience_pk', 'game_experience_pk');
    }
}
