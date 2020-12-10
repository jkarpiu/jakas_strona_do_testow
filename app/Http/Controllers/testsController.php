<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\teacherTest;
use App\User;

class testsController extends Controller
{
    public function createTest(Request $request)
    {
        if (Auth::user()->role == 2) {
            $test = teacherTest::create([
                'start' => $this->parseTime($request['start']),
                'duration' => $request['duration'],
                'threshold' => $request['threshold'],
                'name' => $request['name'],
                'dzialy_id' => $request['dzialy_id'],
                'teacher_id' => Auth::id(),
                'questionsAmount' => $request['questionAmount']
            ]);
            $test->students()->attach($request['students']);
            return response()->json($test);
        }
    }

    public function list()
    {
        return response() ->json(Auth::user()->studentTests);
        if (Auth::user()->role == 1) {
            return response()->json(Auth::user()->studentTests->loadCount(['wyniki' => function ($n) {
                $n->where('id_user', Auth::id());
            }])->where('wyniki_count', '<=', 0)->load("dzial", "teacher"));
        } else if (Auth::user()->role == 2) {
            return response()->json(Auth::user()->teacherTests->load("dzial", "teacher"));
        }
    }

    public function getTestInfo(Request $request)
    {
        if (Auth::user()->role == 1) {
            return response()->json(Auth::user()->studentTests->find($request['id'])->load('teacher'));
        } else if (Auth::user()->role == 2) {
            return response()->json($this->getTestResults($request));
        }
    }

    public function upcomingTests(Request $request)
    {
        if (Auth::user()->role == 2) {
            if (!$request['id']) {
                return response()->json(Auth::user()->studentTests::where(Carbon::parse('start'), '>', Carbon::now()))->where(Carbon::parse('start'), '<', Carbon::now()->addWeeks(2));
            }
        }
    }

    private function getTestResults(Request $request)
    {
        $test = teacherTest::find($request['id'])->load('teacher', 'wyniki.user');
        if (Auth::id() == $test['teacher']['id']) {
            return $test;
        }
    }

    private function parseTime($timestring)
    {
        return Carbon::parse($timestring);
    }
}
