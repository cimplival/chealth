<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
	
    protected $fillable = [
        'on_patient', 'service_id', 'staff_id', 'status', 'scheduled_at','from_user'
    ];

    public function patient()
    {
    	return $this->belongsTo('App\Patient','on_patient');
  	}

    public function service()
    {
      return $this->belongsTo('App\Service','service_id');
    }

  	public function user()
    {
    	return $this->belongsTo('App\user','from_user');
  	}

}
