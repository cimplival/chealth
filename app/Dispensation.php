<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispensation extends Model
{
    
    protected $fillable = [
        'appointment_id',  'drug_id', 'on_patient', 'medication_id', 'quantity_left', 'quantity_consumed', 'status', 'paid', 'from_user'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
  	public function patient()
  	{
    	return $this->belongsTo('App\Patient','on_patient');
  	}

  	public function medication()
    {
      return $this->belongsTo('App\Medication','medication_id');
    }

    public function inventories()
    {
      return $this->belongsTo('App\Inventory','drug_id');
    }
}
