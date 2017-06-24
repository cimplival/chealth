<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'notification_name', 'status', 'from_user'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
}
