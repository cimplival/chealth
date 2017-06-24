<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inpatient extends Model
{
    protected $table = 'inpatients';

    protected $fillable = [
        'patient_id', 'appointment_id', 'ward_id', 'bed_id', 'notes', 'status', 'from_user'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
  	public function patient()
  	{
    	return $this->belongsTo('App\Patient','patient_id');
  	}

    public function ward()
    {
      return $this->belongsTo('App\Ward','ward_id');
    }

    public function bed()
    {
      return $this->belongsTo('App\Bed','bed_id');
    }
}
