<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pytania;
use App\Odpowiedzi;
use PhpParser\Node\Expr\Cast\String_;

class addQuestionController extends Controller
{
    public function addQuestion(Request $request) {
        $pytanie = Pytania::create(
            [
                'tresc' => $request['pytanie'],
                'id_dzial' => $request['dzial'],
                'image' => "test"
            ]
        );
        for ($i = 1; $i <= 4; $i++) {
            Odpowiedzi::create([
                'tresc' => $request['a'.(String)$i],
                'id_pytanie' =>  $pytanie -> id,
                'poprawna' => false,
                'opcja' => 12
            ]);
        }
        dd(Pytania::where('id', $pytanie->id)->get()[0]);
    }


}
