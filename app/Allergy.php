<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
  
  protected $table = 'allergies';

  protected $fillable = [
  'on_patient', 
  'appointment_id',
  'allergy', 
  'severity', 
  'observation_date', 
  'status', 
  'reactions', 
  'notes', 
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
