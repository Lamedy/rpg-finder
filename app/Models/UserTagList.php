<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTagList extends Model
{
    protected $table = 'user_tag_list';
    protected $primaryKey = 'user_tag_list_pk';

    public $timestamps = false;

    protected $fillable = ['user_tag_list_pk', 'user_pk', 'user_game_style_tag_pk'];

    public function tags()
    {
        return $this->belongsTo(GameStyleTag::class, 'user_game_style_tag_pk', 'game_style_tag_pk');
    }
}
