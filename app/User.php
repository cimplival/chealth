<?php

namespace App;
use App\Role;
use App\Report;
use App\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $redirectTo = '/';

    protected $fillable = [
        'full_name', 'user_name', 'password', 'staff_id', 'email', 'phone_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function reports()
    {
        return $this->belongsToMany('App\Report')->withTimestamps();
    }

    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }
        return false;
    }

    public function hasReport($name)
    {
        foreach($this->reports as $report)
        {
            if($report->name == $name) return true;
        }
        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function assignReport($report)
    {
        return $this->reports()->attach($report);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    public function removeReport($report)
    {
        return $this->reports()->detach($report);
    }

    public function appointments()
    {
        return $this->hasMany('App\Appointments','on_patient');
    }
    
    public function vitals()
    {
        return $this->hasMany('App\Vital','from_user');
    }

    public function secondaryvitals()
    {
        return $this->hasMany('App\Vitals2','from_user');
    }

    public function diagnosis()
    {
        return $this->hasMany('App\Diagnosis','from_user');
    }

    public function immunizations()
    {
        return $this->hasMany('App\Immunization','from_user');
    }

    public function therapies()
    {
        return $this->hasMany('App\Therapy','from_user');
    }

    public function procedures()
    {
        return $this->hasMany('App\Procedure','from_user');
    }

    public function histories()
    {
        return $this->hasMany('App\History','from_user');
    }

    public function allergies()
    {
        return $this->hasMany('App\Allergy','from_user');
    }

    public function labs()
    {
        return $this->hasMany('App\Lab','on_patient');
    }

    public function services()
    {
        return $this->hasMany('App\Service','from_user');
    }

    public function inventories()
    {
        return $this->hasMany('App\Inventory','from_user');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity','from_user');
    }
}
