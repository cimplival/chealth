<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
	protected $fillable = [
        'on_patient',  'appointment_id', 'drug_id', 'status', 'cost', 'service_id', 'insurance_id', 'provider_id', 'from_user'
    ];

    public function patient()
    {
    	return $this->belongsTo('App\Patient','on_patient');
  	}

  	public function service()
    {
      return $this->belongsTo('App\Service', 'service_id');
    }

    public function appointment()
    {
      return $this->belongsTo('App\Appointment', 'appointment_id');
    }

    public function insurance_plan()
    {
      return $this->belongsTo('App\InsurancePlan', 'insurance_id');
    }

    public function provider()
    {
      return $this->belongsTo('App\Provider', 'provider_id');
    }

}
