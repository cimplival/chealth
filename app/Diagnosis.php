<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    
    protected $table = 'diagnosis';

    protected $fillable = [
        'on_patient',  'appointment_id','diagnosis', 'from_date', 'to_date', 'notes', 'from_user'
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
