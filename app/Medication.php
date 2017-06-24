<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{

    protected $fillable = [
        'appointment_id', 'drug_id', 'on_patient', 'description', 'quantity_consumed','times_a_day', 'no_of_days', 'from_date', 'to_date', 'from_user'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
  	public function patient()
  	{
    	return $this->belongsTo('App\Patient','on_patient');
  	}

    public function inventory()
    {
      return $this->belongsTo('App\Inventory','drug_id');
    }

}
