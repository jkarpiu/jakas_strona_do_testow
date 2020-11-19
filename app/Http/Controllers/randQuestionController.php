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
        $wszystkiepytania = Pytania::where('id_dzial', (int)$dzial)->get(['id']);
        $pytanie = $wszystkiepytania[rand(1, sizeof($wszystkiepytania)) - 1];
        return Pytania::where('id', $pytanie->id)->with('odpowiedzi')->get();
    }
    public function onequestion()
    {
        return view('random');
    }

    public function json_onequestion(Request $request)
    {
        return response()->json($this->getQuestion(1, $request['dzial']));
    }

    public function odpowiadanie(Request $request)
    {
        $odpowiedz = Odpowiedzi::where('id', $request['odpowiedz'])->get()->first();
        if ($odpowiedz['poprawna'] == false) {
            Session::flash('sprawdzanie', 'zła odpowiedź');
            return view('random', ['pytanie' => [$odpowiedz->pytanie]]);
        } else {
            Session::flash('sprawdzanie', 'DOBRA ODPOWIEDZ!Q!!');
            return view('random', ['pytanie' => [$odpowiedz->pytanie]]);
        }
    }
}
