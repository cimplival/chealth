<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{

    protected $fillable = [
        'appointment_id', 'on_patient', 'weight', 'height', 'bmi', 'blood_pressure', 'pulse', 'temperature', 'from_user'
    ];

    public function author()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
  	// returns patient of any vital
  	public function patient()
  	{
    	return $this->belongsTo('App\Patient','onPatient');
  	}

}
