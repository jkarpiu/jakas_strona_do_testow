<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pytania;
use App\Odpowiedzi;
use App\Dzialy;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\String_;
use Illuminate\Support\Facades\Auth;

class addQuestionController extends Controller
{
    public function addDzial(Request $request)
    {
        if (Auth::user()->role == 2) {
            $dzial = Dzialy::create([
                'nazwa' => $request['title']
            ]);
            foreach($request['question'] as $q){
                Pytania::create([

                ]);
            }
            return response()->json($request);
        }
    }
    public function addQuestion(Request $request)
    {
        $pytanie = Pytania::create(
            [
                'tresc' => $request['pytanie'],
                'id_dzial' => $request['dzial'],
                'image' => "test"
            ]
        );
        for ($i = 1; $i <= 4; $i++) {
            Odpowiedzi::create([
                'tresc' => $request['a' . (string)$i],
                'id_pytanie' =>  $pytanie->id,
                'poprawna' => ($request['valid'] == 'a' . (string)$i),
            ]);
        }
        Session::flash('message', 'Dodano pytanie');
        return back();
    }
}
