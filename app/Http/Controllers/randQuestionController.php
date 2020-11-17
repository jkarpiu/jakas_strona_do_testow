<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dzialy;
use App\Pytania;

class randQuestionController extends Controller
{
    function getQuestion()
    {
        $nr_pytania = rand(1, Pytania::count());
        $pytanie = Pytania::where('id', $nr_pytania)->with('odpowiedzi')->get();
        return $pytanie;
    }
    public function onequestion()
    {
        return view('random', ['pytanie' => $this->getQuestion()]);
    }

    public function json_onequestion()
    {
        return response()->json($this->getQuestion());
    }
}
