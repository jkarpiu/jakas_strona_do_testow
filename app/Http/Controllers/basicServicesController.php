<?php

namespace App\Http\Controllers;

use App\Dzialy;
use Illuminate\Http\Request;

class basicServicesController extends Controller
{
    public function dzialy() {
        return response() -> json(
            Dzialy::get()
        );
    }
}
