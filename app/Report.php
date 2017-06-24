<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'name','description', 'status', 'from_user'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
