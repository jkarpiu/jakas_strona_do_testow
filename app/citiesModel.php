<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class citiesModel extends Model
{
    public function region() {
        $this -> belongsTo(Region::class, 'region_id');
    }
}
