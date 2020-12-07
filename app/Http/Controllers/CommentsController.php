<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comments;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function addcomment(Request $request){
        comments::create([
            'tresc' => $request ['tresc'],
            'group_post_id' => $request ['post_id'],
            'user_id' => Auth::id(),
        ]);
    }
}
