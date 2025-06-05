<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeList extends Model
{
    protected $table = 'notice_list';
    protected $primaryKey = 'notice_list_pk';

    protected $fillable = ['notice_list_pk', 'notice_type', 'from_user', 'for_user', 'create_at', 'answer'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user', 'user_pk');
    }

    public function playerSessionAuthor()
    {
        return $this->hasOne(PlayerListOfGameSession::class, 'notice_for_author', 'notice_list_pk');
    }
    public function playerSessionUser()
    {
        return $this->hasOne(PlayerListOfGameSession::class, 'notice_for_user', 'notice_list_pk');
    }
}
