<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserContactsList extends Model
{
    protected $table = 'user_contacts_list';
    protected $primaryKey = 'user_contacts_list_pk';

    public $timestamps = false;

    protected $fillable = ['user_contacts_list_pk', 'user_pk', 'contact_methods_pk', 'contact_value'];

    public function contacts()
    {
        return $this->belongsTo(ContactMethods::class, 'contact_methods_pk', 'contact_methods_pk');
    }
}
