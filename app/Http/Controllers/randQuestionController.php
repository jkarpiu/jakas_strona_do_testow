<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Dzialy;
use Illuminate\Support\Str;
use App\Pytania;
use App\Odpowiedzi;
use App\activeTests;
use DateTime;
use Carbon\Carbon;

class randQuestionController extends Controller
{
    function getQuestion($amount, $dzial)
    {
        $finalpytania = [];
        for ($i = 0; $i < $amount; $i++) {
            $wszystkiePytania = Pytania::where('id_dzial', (int)$dzial)->get(['id']);
            $pytanieSamoId = $wszystkiePytania[rand(1, sizeof($wszystkiePytania)) - 1];
            $pytanie = Pytania::where('id', $pytanieSamoId->id)->with('odpowiedzi:id,tresc,id_pytanie')->get()->first();
            if(in_array($pytanie, $finalpytania)){
                $i --;
            }else 
                $finalpytania[$i] = $pytanie;
        }
        return $finalpytania;
    }
    public function onequestion()
    {
        return view('random');
    }

    public function json_onequestion(Request $request)
    {
        $response = [
            'questions' =>  $this->getQuestion($request['amount'], $request['dzial']),
            'session' => activeTests::create([
                'token' => Str::random(32),
                'deadline' => Carbon::now() ->addMinutes(60) 
                ])
        ];
        return response()->json($response);
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

    public function json_odpowiadanie(Request $request)
    {
        // $currentTime = new DateTime();
        // $testSession = activeTests::where('id', $request['session']['id'])->get()->first();
        return response() -> json($request);

// $currentTime < $testSession['deadLine'] && 
        // if ($request['session']['token'] == $testSession['token']) {
        //     $valid = [];
        //     // foreach ($request['answers'] as $odpowiedz) {
        //     //     array_push($valid, Odpowiedzi::where('id', (int)$odpowiedz)->get());
        //     // }
        //     $testSession['sent'] = true;
        //     $testSession->save();
        //     return response()->json($valid);
        // } else {
        //     return response()->json(['messenge' => $currentTime], 401);
        // }
    }
}
