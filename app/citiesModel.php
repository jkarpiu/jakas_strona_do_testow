<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class citiesModel extends Model
{
    public function region() {
        return $this -> belongsTo(Region::class, 'region_id');
    }

    public function schools() {
        return $this -> hasMany('App\schoolsModel', 'id_city');
    }
}
