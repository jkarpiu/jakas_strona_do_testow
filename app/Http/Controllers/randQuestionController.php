<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dzialy;
use Illuminate\Support\Str;
use App\Pytania;
use App\Odpowiedzi;
use App\activeTests;
use Carbon\Carbon;
use App\wyniki;
use Illuminate\Support\Facades\Auth;

class randQuestionController extends Controller
{
    function getQuestion($amount, $dzial)
    {
        return Pytania::where('id_dzial', $dzial)->inRandomOrder()->with('odpowiedzi')->limit($amount)->get();
    }
    public function onequestion()
    {
        return view('random');
    }

    public function json_onequestion(Request $request)
    {
        $response = [
            'questions' =>  $this->getQuestion($request['amount'], (int)$request['dzial']),
            'session' => activeTests::create([
                'token' => Str::random(32),
                'deadline' => Carbon::now()->addMinutes(1),
                'dzial_id' => (int)$request['dzial']
            ])->load('dzial'),
        ];
        return response()->json($response);
    }

    public function odpowiadanie(Request $request)
    {
        return view('random');
    }

    public function json_odpowiadanie(Request $request)
    {
        Auth::shouldUse('api');
        $testSession = activeTests::find($request['session']['id']);
        if ($request['session']['token'] == $testSession['token'] && Carbon::parse($testSession['deadLine'])->diffInMilliseconds(Carbon::now()) > 0 && $testSession['sent'] == false) {
            $valid = [
                'answers' => [],
                'results' =>  null
            ];
            $rightAnswers = 0;
            foreach ($request['answers'] as $key => $item) {
                array_push(
                    $valid['answers'],
                    [
                        'zaznaczana' => Odpowiedzi::select('poprawna', 'id', 'id_pytanie')->where('id', $item['answer'])->get()->first(),
                        'poprawna' => null,
                    ]
                );
                if ($valid['answers'][$key]['zaznaczana']->poprawna) {
                    $valid['answers'][$key]['poprawna'] =  $valid['answers'][$key]['zaznaczana'];
                    $rightAnswers++;
                } else {
                    $valid['answers'][$key]['poprawna']  = Odpowiedzi::select('id', 'poprawna')
                        ->where('id_pytanie', $item['question'])
                        ->where('poprawna', true)->get()->first();
                }
            }
            $testSession['sent'] = true;
            $testSession->save();
            $valid['results'] = [
                'points' => $rightAnswers,
                'max_points' => sizeof($request['answers']),
                'percentage' => (($rightAnswers / sizeof($request['answers'])) * 100) ,
                'passed' => (($rightAnswers / sizeof($request['answers'])) * 100) >= Dzialy::find($request['session']['dzial_id'])['prog']
            ];
            if (Auth::user()) {
                wyniki::create([
                    'id_user' => Auth::id(),
                    'id_dzial' => $request['session']['dzial_id'],
                    'active_test_id' => $testSession['id'],
                    'max_points' => $valid['results']['max_points'],
                    'points' => $rightAnswers,
                    'passed' => $valid['results']['passed']
                ]);
            }
            return response()->json($valid);
        } else {
            return response()->json($request, 401);
        }
    }
}
