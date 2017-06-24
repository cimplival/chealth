<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Therapy extends Model
{

    protected $table = 'therapies';

    protected $fillable = [
        'on_patient', 'appointment_id', 'therapy_name','date_administered', 'from_user'
    ];

    public function author()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
  	// returns patient of any vital
  	public function patient()
  	{
    	return $this->belongsTo('App\Patient','on_patient');
  	}
}
