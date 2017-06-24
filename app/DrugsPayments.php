<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugsPayments extends Model
{
    
    protected $fillable = [
        'drug_id', 'drug_name', 'formulation', 'description', 'per_cost','updatedBy'
    ];

}
