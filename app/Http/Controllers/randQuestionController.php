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
        return Pytania::where('id_dzial', $dzial)->inRandomOrder()->with(['odpowiedzi' => function ($n) {
            $n->inRandomOrder();
        }])->limit($amount)->get();
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
                'deadline' => Carbon::now()->addMinutes(60),
                'dzial_id' => (int)$request['dzial']
            ])->load('dzial'),
        ];
        return response()->json($response);
    }


    protected function odpowiadanie(Request $request)
    {
        $testSession = activeTests::find($request['session']['id']);
        if ($request['session']['token'] == $testSession['token'] && Carbon::parse($testSession['deadLine'])->diffInMilliseconds(Carbon::now()) > 0 && $testSession['sent'] == false) {
            $valid = [
                'answers' => [],
                'results' =>  null,
                'id_session' => $testSession['id']
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
                'percentage' => (($rightAnswers / sizeof($request['answers'])) * 100),
                'passed' => (($rightAnswers / sizeof($request['answers'])) * 100) >= Dzialy::find($request['session']['dzial_id'])['prog']
            ];
            return $valid;
        } else {
            return 401;
        }
    }

    public function json_odpowiadanie_anon(Request $request)
    {
        return response()->json($this->odpowiadanie($request));
    }
    public function json_odpowiadanie_zalogowany(Request $request)
    {
        $results = $this->odpowiadanie($request);
        if ($results != 401 && $results != null) {
            wyniki::create([
                'id_user' => Auth::id(),
                'id_dzial' => $request['session']['dzial_id'],
                'active_test_id' => $results['id_session'],
                'max_points' => $results['results']['max_points'],
                'points' => $results['results']['points'],
                'passed' => $results['results']['passed']
            ]);
            return response()->json($results);
        } else
            return 401;
    }
}
