<?php

namespace App;

use App\User;
use App\Dzialy;

use Illuminate\Database\Eloquent\Model;

class wyniki extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function dzial() {
        return $this->belongsTo('App\Dzialy', 'id_dzial');
    }
}
