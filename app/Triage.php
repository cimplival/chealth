<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Triage extends Model
{

    protected $table = 'triage_vitals';

    protected $fillable = [
        'on_patient', 'appointment_id', 'service_id','status', 'from_user'
    ];

    public function patient()
    {
    	return $this->belongsTo('App\Patient','on_patient');
  	}

  	public function service()
    {
    	return $this->belongsTo('App\Service','service_id');
  	}

    public function appointment()
    {
      return $this->belongsTo('App\Appointment','appointment_id');
    }

}
