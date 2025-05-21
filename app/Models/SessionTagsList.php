<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionTagsList extends Model
{
    protected $primaryKey = 'session_tags_list_pk';

    protected $table = 'session_tags_list';

    protected $fillable = ['session_tags_list_pk', 'game_session_pk', 'game_style_tag_pk'];

    public $timestamps = false;

    public function tag()
    {
        return $this->belongsTo(GameStyleTag::class, 'game_style_tag_pk', 'game_style_tag_pk');
    }
}
