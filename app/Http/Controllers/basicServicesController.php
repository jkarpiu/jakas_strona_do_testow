<?php

namespace App\Http\Controllers;

use App\Dzialy;
use App\schoolType;
use App\regionsModel;
use App\citiesModel;
use Illuminate\Http\Request;

class basicServicesController extends Controller
{
    public function dzialy()
    {
        return response()->json(
            Dzialy::get()
        );
    }

    public function typy_szkol()
    {
        return response()->json(SchoolType::get());
    }

    public function wojewodztwa()
    {
        return response()->json(regionsModel::get());
    }

    public function miasta(Request $request)
    {
        return response()->json(
            regionsModel::with('cities')->find($request['id'])->cities
        );
    }
    public function szkoly(Request $request)
    {
        return response()->json(
            citiesModel::with('schools')->find($request['id'])->schools
        );
    }
    public function user(Request $request)
    {
        return response() -> json($request->user());
    }
}
