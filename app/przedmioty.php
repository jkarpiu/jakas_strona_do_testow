<?php

namespace App;

use App\Dzialy;
use Illuminate\Database\Eloquent\Model;

class przedmioty extends Model
{
    public function dzial()
    {
        return $this->belongsTo('App\Dzialy', 'id_dzial');
    }
}
