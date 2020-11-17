<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Dzialy;
use App\Pytania;
use App\Odpowiedzi;

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

    public function odpowiadanie(Request $request)
    {
        $odpowiedz = Odpowiedzi::where('id', $request['odpowiedz'])->get()->first();
        if($odpowiedz['poprawna'] == false)
        {
            Session::flash('sprawdzanie', 'zła odpowiedź');
            return view('random', ['pytanie'=>[$odpowiedz->pytanie]]);
        }
        else
        {
            Session::flash('sprawdzanie', 'DOBRA ODPOWIEDZ!Q!!');
            return view('random', ['pytanie'=>[$odpowiedz->pytanie]]);
        }
    }
}
