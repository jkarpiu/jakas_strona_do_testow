<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schoolType extends Model
{
    public function schoold() {
        return $this -> hasMany('App\schoolsModel', 'id_school_type');
    }
}
