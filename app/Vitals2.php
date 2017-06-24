<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vitals2 extends Model
{

    protected $table = 'secondary_vitals';

    protected $fillable = [
        'on_patient',  'appointment_id', 'cardiovascular', 'respiratory', 'abdomen', 'blood_sugar', 'stool', 'urine', 'hiv_I_II', 'haemoglobin', 'conclusion', 'name_designate', 'from_user'
    ];

    public function author()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
  	public function patient()
  	{
    	return $this->belongsTo('App\Patient','on_patient');
  	}
}