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

    public function playerSession()
    {
        return $this->hasOne(PlayerListOfGameSession::class, 'notice_list_pk', 'notice_list_pk');
    }
}
