<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activeTests extends Model
{
    protected $fillable = ['token', 'deadline'];
}
