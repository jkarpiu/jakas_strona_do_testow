<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Dirape\Token\Token;
use Illuminate\Support\Carbon;

use App\groupsModel;
use App\GroupInvitation;
use App\groupPost;

class groupsController extends Controller
{
    public function list_groups()
    {
        if (Auth::user()->role == 1)
            return response()->json(Auth::user()->studentGroups);
        else if (Auth::user()->role == 2)
            return response()->json(Auth::user()->teacherGroups);
    }

    public function list_group_students(Request $request) {
        return response() -> json(groupsModel::find($request['id'])->students);
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

    public function create_invitation(Request $request)
    {
        if ((groupsModel::find($request['id'])->teacher)['id'] == Auth::id()) {
            return response()->json(GroupInvitation::create([
                'code' => (new Token())->unique('group_invitations', 'code', 8),
                'expire_date' => Carbon::now()->addMonth(),
                'groups_model_id' => $request['id']
            ]));
        } else
            throw 401;
    }

    public function join_group(Request $request)
    {
        if (Auth::user()->role == 1) {
            $invitation = GroupInvitation::where('code', $request['code'])->with(['group' => function ($n) {
                $n->with('students');
            }])->get();
            if (!empty($invitation) && Carbon::parse($invitation[0]['expire_date']) > Carbon::now()) {
                if (!in_array(Auth::id(), $invitation[0]->group->students->all())) {
                    $invitation[0]->group->students()->attach(Auth::id());
                    return response()->json(Auth::user()->studentGroups);
                }
            } else {
                return response()->json('Niepoprawny kod', 401);
            }
        }
    }
    public function add_post(Request $request)
    {
        $group = groupsModel::find($request['id']);
        if ($group->teacher->id == Auth::id()) {
            return response()->json(groupPost::create([
                'author_id' => Auth::id(),
                'groups_model_id' => $group['id'],
                'content' => $request['content'],
                'title' => $request['title']
            ]));
        } else
            return response()->json(401);
    }
    public function remove_post(Request $request)
    {
        $post = groupPost::find($request['id']);
        if ($post['author_id'] == Auth::id()){
            $post->delete();
        }
    }
    public function list_posts(Request $request)
    {
        $group = groupsModel::find($request['id']);
        if ($group->students->contains(Auth::id()) || $group->teacher->id == Auth::id()) {
            return response()->json($group->posts->where('active', true)->load('author', 'comments.author'));
        }
    }
}
