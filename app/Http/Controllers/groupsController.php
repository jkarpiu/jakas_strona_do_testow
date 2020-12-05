<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\groupsModel;
use Illuminate\Support\Facades\Auth;

class groupsController extends Controller
{
    public function list_groups()
    {
        return response()->json(Auth::user() -> teacherGroups);
    }

    public function add_group(Request $request)
    {
        if ($request->user()->role == 2) {
            groupsModel::create([
                'teacher_id' => $request->user()->id,
                'name' => $request['name']
            ]);
        }
    }
}
