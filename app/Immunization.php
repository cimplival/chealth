<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{

    protected $table = 'immunizations';

    protected $fillable = [
        'on_patient', 'appointment_id','vaccine', 'date_administered', 'from_user'
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
