<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
  protected $table = 'wards';

  protected $fillable = [
      'ward_name', 'ward_notes', 'ward_status', 'ward_capacity', 'ward_occupied', 'from_user'
  ];

  public function user()
  {
    return $this->belongsTo('App\User','from_user');
  }

  public function beds()
  {
      return $this->hasMany('App\Bed','bed_no');
  }

}
