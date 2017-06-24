<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = [
        'on_patient',  'appointment_id', 'service_id', 'status', 'from_user'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
  	public function patient()
  	{
    	return $this->belongsTo('App\Patient','on_patient');
  	}

    public function service()
    {
      return $this->belongsTo('App\Service','service_id');
    }
}
