<?php

namespace App;

use App\przedmioty;
use App\Pytania;
use Illuminate\Database\Eloquent\Model;

class Dzialy extends Model
{
    public function pytanie()
    {
        return $this->hasMany('App\Pytania');
    }
    public function przedmiot()
    {
        return $this->hasMany('App\przedmioty');
    }
}
