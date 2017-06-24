<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
  
  protected $table = 'beds';

  protected $fillable = [
      'ward_no', 'bed_no','bed_notes', 'bed_status', 'from_user'
  ];

  public function users()
  {
    return $this->belongsTo('App\User','from_user');
  }

  public function ward()
  {
    return $this->belongsTo('App\Ward','ward_no');
  }


  public function patient()
  {
    return $this->belongsTo('App\Patient','onPatient');
  }

}
