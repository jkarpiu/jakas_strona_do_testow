<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\wyniki;

class userController extends Controller
{
    public function wyniki() {
        return response() -> json(wyniki::where('id_user', Auth::id())->with('dzial') -> get() );
    }
}
