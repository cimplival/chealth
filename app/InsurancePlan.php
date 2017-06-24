<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsurancePlan extends Model
{
    protected $table = 'insurance_plans';

    protected $fillable = [
        'on_patient', 'national_id', 'insurance_identifier', 'provider_id', 'confirmed', 'from_user'
    ];

    public function users()
    {
    	return $this->belongsTo('App\User','from_user');
  	}

  	public function patient()
    {
    	return $this->belongsTo('App\Patient','on_patient');
  	}

    public function provider()
    {
      return $this->belongsTo('App\Provider', 'provider_id');
    }
}
