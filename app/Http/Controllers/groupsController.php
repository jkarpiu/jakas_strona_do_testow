<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class groupsController extends Controller
{
    public function list_groups() {
        return response() -> json('dupa');
    }
}
