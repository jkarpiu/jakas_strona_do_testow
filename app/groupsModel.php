<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class groupsModel extends Model
{
    protected $fillable = ['teacher_id', 'name', 'school_id'];

    public function teacher() {
        return $this->belongsTo('App\User', 'teacher_id');
    }

    public function school() {
        return $this -> belongsTo('App\schoolsModel', 'school_id');
    }

    public function students() {
        return $this ->belongsToMany(User::class);
    }

    public function invitations() {
        return $this->hasMany(GroupInvitation::class);
    }
}
