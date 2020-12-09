<?php

namespace App;

use App\przedmioty;
use App\Pytania;
use App\wyniki;
use Illuminate\Database\Eloquent\Model;

class Dzialy extends Model
{
    protected $fillable = ['nazwa'];
    public function pytanie()
    {
        return $this->hasMany('App\Pytania', 'id_dzial');
    }
    public function przedmiot()
    {
        return $this->hasMany('App\przedmioty');
    }
    public function wyniki() {
        return $this -> hasMany('App\Wyniki', 'id_dzial');
    }
    public function testy() {
        return $this->hasMany(activeTests::class, 'dzial_id');
    }

    public function owner(){
        return $this -> belongsTo(User::class, 'owner_id');
    }
}
