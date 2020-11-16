<?php

namespace App;

use App\Pytania;
use Illuminate\Database\Eloquent\Model;

class Dzialy extends Model
{
    public function pytanie()
    {
        return $this->hasMany('app\Pytania');

    }
}
