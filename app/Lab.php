<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{

    protected $table = 'labs';

    protected $fillable = [
        'on_patient', 'appointment_id', 'lab_name', 'lab_notes', 'lab_review', 'status', 'lab_document', 'from_user'
    ];

    public function patient()
    {
      return $this->belongsTo('App\Patient','on_patient');
    }

    public function user()
    {
    	return $this->belongsTo('App\User','from_user');
  	}
  	
}
