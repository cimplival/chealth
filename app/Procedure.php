<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    
    protected $table = 'procedures';

    protected $fillable = [
        'on_patient', 
        'appointment_id', 
        'procedure_name', 
        'procedure_type', 
        'procedure_notes', 
        'from_date', 
        'to_date', 
        'duration', 
        'from_user'
    ];

    public function author()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
  	// returns patient of any vital
  	public function patient()
  	{
    	return $this->belongsTo('App\Patient','onPatient');
  	}
}
