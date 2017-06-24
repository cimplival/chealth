<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $fillable = [
        'drug_id', 'drug_name', 'formulation', 'description','quantity', 'per_cost', 'expiry_date', 'from_user'
    ];

    public function users()
    {
    	return $this->belongsTo('App\User','from_user');
  	}

}
