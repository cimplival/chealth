<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	protected $fillable = [
	'from_user', 
	'description'
	];

	public function users()
	{
		return $this->belongsTo('App\User','from_user');
	}
}
