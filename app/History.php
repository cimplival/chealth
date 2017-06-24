<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    
    protected $table = 'histories';

    protected $fillable = [
        'on_patient', 
        'appointment_id',
        'history', 
        'relationship', 
        'notes', 
        'from_date', 
        'to_date', 
        'status', 
        'from_user'
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
