<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnknownPatient extends Model
{
    protected $fillable = [
        'patient_id', 'appointment_id','from_user'
    ];

    public function patient()
    {
    	return $this->belongsTo('App\Patient','patient_id');
  	}

  	public function user()
    {
    	return $this->belongsTo('App\User','from_user');
  	}

    public function appointment()
    {
      return $this->belongsTo('App\Appointment', 'appointment_id');
    }
}
