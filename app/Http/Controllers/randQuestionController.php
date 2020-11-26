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
        return Pytania::where('id_dzial', $dzial)->inRandomOrder() ->with('odpowiedzi')->limit($amount)->get();
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
                'deadline' => Carbon::now()->addMinutes(60)
            ])
        ];
        return response()->json($response);
    }

    public function odpowiadanie(Request $request)
    {
        return view('random');
    }

    public function json_odpowiadanie(Request $request)
    {
        $testSession = activeTests::where('id', $request['session']['id'])->get()->first();
        if ($request['session']['token'] == $testSession['token'] && Carbon::parse($testSession['deadLine'])->diffInMinutes(Carbon::now()) > 0 && $testSession['sent'] == false) {
            $valid = [];
            foreach ($request['answers'] as $key => $odpowiedz) {
                array_push(
                    $valid,
                    [
                        'zaznaczana' => Odpowiedzi::select('poprawna', 'id', 'id_pytanie')->where('id', $odpowiedz)->get()->first(),
                        'poprawna' => null
                    ]
                );
                $valid[$key]['poprawna'] = $valid[$key]['zaznaczana']->poprawna ? $valid[$key]['zaznaczana']
                    : Odpowiedzi::select('id', 'poprawna')
                    ->where('id_pytanie', $valid[$key]['zaznaczana']->id_pytanie)
                    ->where('poprawna', true)->get()->first();
            }
            $testSession['sent'] = true;
            $testSession->save();
            return response()->json($valid);
        } else {
            return response()->json(['messenge' => 'Twój czas minął'], 401);
        }
    }
}
