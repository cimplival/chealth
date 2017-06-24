<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    protected $fillable = [
        'name', 'from_user'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','from_user');
  	}

}
