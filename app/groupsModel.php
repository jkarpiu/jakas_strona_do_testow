<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class groupsModel extends Model
{
    public function teacher() {
        return $this->belongsTo('App\User', 'teacher_id');
    }

    public function school() {
        return $this -> belongsTo('App\schoolsModel', 'school_id');
    }
}
