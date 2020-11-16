<?php

namespace App;

use App\Pytania;
use Illuminate\Database\Eloquent\Model;

class Odpowiedzi extends Model
{
    public function pytanie()
    {
        return $this->belongsTo('App\Pytanie', 'id_pytanie');
    }
}
