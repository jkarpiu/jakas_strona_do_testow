<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class schoolsModel extends Model
{
    public function school_type() {
        $this -> belongsTo('App\schoolType', 'school_type_id');
    }

    public function groups() {
        $this->hasMany('App\groupsModel', 'school_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
