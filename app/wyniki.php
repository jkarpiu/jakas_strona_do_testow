<?php

namespace App;

use App\User;
use App\Dzialy;

use Illuminate\Database\Eloquent\Model;

class wyniki extends Model
{

    protected $fillable = ['id_user', 'id_dzial', 'active_test_id', 'max_points', 'points'];
    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function dzial() {
        return $this->belongsTo('App\Dzialy', 'id_dzial');
    }

    public function test() {
        return $this->hasOne(activeTests::class, 'active_test_id');
    }
}
