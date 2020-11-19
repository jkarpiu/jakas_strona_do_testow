<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Dzialy;
use App\Pytania;
use App\Odpowiedzi;

class randQuestionController extends Controller
{
    function getQuestion($amount, $dzial)
    {
        $wszystkiepytania = Pytania::select('id')->where('id_dzial', $dzial)->get();
        $nr_pytania = rand(1, sizeof($wszystkiepytania)-1);
        $pytanie = Pytania::where('id', $nr_pytania)->with('odpowiedzi')->take($amount)->get();
        return $pytanie;
    }
    public function onequestion()
    {
        return view('random', ['pytanie' => $this->getQuestion(1,1)]);
    }

    public function json_onequestion(Request $request)
    {
        return response()->json($this->getQuestion(1, $request['dzial']));
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
