<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dzialy;
use App\Pytania;

class randQuestionController extends Controller
{
    public function onequestion()
    {
     $nr_pytania = rand(1,Pytania::count());
     $pytanie = Pytania::where('id', $nr_pytania)->get();
        return view('random', ['pytanie'=>$pytanie]);

    }
}
