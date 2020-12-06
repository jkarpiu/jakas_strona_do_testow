<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\teacherTest;

class testsController extends Controller
{
    public function create(Request $request)
    {
        if (Auth::user()->role == 2) {
            $test = teacherTest::create([
                'start' => $this -> parseTime($request['time']),
                'end' => $this -> parseTime($request['time']) -> addMinutes($request['duration']),
                'dzialy_id' => $request['dzialy_id'],
                'teacher_id' => Auth::id()
            ]);
            $test -> students() -> attach($request['students']);
        }
    }

    public function list() {
        if (Auth::user() -> role == 2 ) {
            return response() -> json(Auth::user() -> teacherTests);
        }
    }

    private function parseTime($timestring)
    {
        return Carbon::parse(date_create_from_format('D M d Y H:i:s e+', $timestring));
    }
}
