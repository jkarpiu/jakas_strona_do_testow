<?php

namespace App;

use App\User;
use App\Dzialy;

use Illuminate\Database\Eloquent\Model;

class wyniki extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function dzial() {
        return $this->belongsTo('App\Dzialy', 'dzialy_id');
    }
}
