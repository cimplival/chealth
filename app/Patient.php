<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    
    protected $fillable = [
        'med_id', 'first_name', 'middle_name', 'last_name', 'date_birth', 'estimated_age', 'gender',
        'patient_phone', 'kin_name', 'kin_relationship', 'kin_phone', 'email', 'residence', 'county', 'country_origin', 'from_user'
    ];

    public function appointments()
    {
        return $this->hasMany('App\Appointment','on_patient');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment','on_patient');
    }

    public function triages()
    {
        return $this->hasMany('App\Triage','on_patient');
    }

    public function services()
    {
        return $this->hasMany('App\Service','on_patient');
    }

    public function vitals()
  	{
    	return $this->hasMany('App\Vital','on_patient');
  	}

    public function secondaryvitals()
    {
        return $this->hasMany('App\Vitals2','on_patient');
    }

    public function diagnosis()
    {
      return $this->hasMany('App\Diagnosis','on_patient');
    }

    public function immunizations()
    {
      return $this->hasMany('App\Immunization', 'on_patient');
    }

    public function therapies()
    {
      return $this->hasMany('App\Therapy', 'on_patient');
    }

    public function procedures()
    {
        return $this->hasMany('App\Procedure','on_patient');
    }

    public function medication()
    {
      return $this->hasMany('App\Medication','on_patient');
    }

    public function allergies()
    {
        return $this->hasMany('App\Allergy','on_patient');
    }

    public function labs()
    {
        return $this->hasMany('App\Lab','on_patient');
    }


    public function bed()
    {
      return $this->belongsTo('App\Bed','bed_no');
    }

    // returns the instance of the user who is author of that vital
    public function author()
    {
        return $this->belongsTo('App\User','id');
    }

}
