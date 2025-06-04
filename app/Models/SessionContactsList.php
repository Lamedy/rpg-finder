<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionContactsList extends Model
{
    protected $table = 'session_contacts_list';
    protected $primaryKey = 'session_contacts_list_pk';

    public $timestamps = false;

    protected $fillable = ['session_contacts_list_pk', 'game_session_pk', 'contact_methods_pk', 'contact_value'];

    public function contacts()
    {
        return $this->belongsTo(ContactMethods::class, 'contact_methods_pk', 'contact_methods_pk');
    }
}
