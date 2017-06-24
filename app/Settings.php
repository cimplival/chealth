<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'name_of_institution', 'tagline', 'email_address', 'phone_no', 'currency', 'postal_address', 'location', 'website', 'from_user'
    ];

    public function users()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
}
