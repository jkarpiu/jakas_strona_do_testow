<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class regionsModel extends Model
{
    public function cities() {
        return $this-> hasMany( citiesModel::class, 'region_id');
    }
}
