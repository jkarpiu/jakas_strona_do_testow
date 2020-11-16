<?php

namespace App;

use App\Dzialy;
use Illuminate\Database\Eloquent\Model;

class Pytania extends Model
{
    public function dzial()
    {
        return $this->belongsTo('App\Dzialy', 'id_dzial');
    }
    public function odpowiedzi()
    {
        return $this->hasMany('app\Odpowiedzi');

    }
}
