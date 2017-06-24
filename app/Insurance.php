<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{

    protected $fillable = [
        'on_patient',  'appointment_id', 'payment_id','insurance_id' ,'service_id', 'cost', 'from_user'
    ];

    public function patient()
    {
    	return $this->belongsTo('App\Patient','on_patient');
  	}

  	public function service()
    {
    	return $this->belongsTo('App\Service','service_id');
  	}

    public function payment()
    {
      return $this->belongsTo('App\Payment','payment_id');
    }

    public function appointment()
    {
      return $this->belongsTo('App\Appointment', 'appointment_id');
    }

    public function insurance_plan()
    {
      return $this->belongsTo('App\InsurancePlan', 'insurance_id');
    }

    public function user()
    {
      return $this->belongsTo('App\User', 'from_user');
    }
}
