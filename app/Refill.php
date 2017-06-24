<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refill extends Model
{
    
    protected $fillable = [
        'drug_id' ,'drug_name', 'formulation', 'description', 'quantity', 'expiry_date', 'from_user'
    ];

}
