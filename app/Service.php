<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'provider_id', 'service_name', 'cost', 'status', 'inpatient_status', 'lab_status', 'from_user'
    ];

    public function users()
    {
    	return $this->belongsTo('App\User','from_user');
  	}

    public function provider()
    {
        return $this->belongsTo('App\Provider','provider_id');
    }
}
