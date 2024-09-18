<?php

namespace App\Http\Controllers;

use App\Models\FromLikar;
use App\Models\LikarSpecialists;
use App\Models\Pages;
use App\Models\Roles;
use App\Models\Specialists;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index(){
        $access = User::select('access')->where('id', Auth::user()->id)->first();

        if(!in_array('read', json_decode(Auth::user()->access, true)['koristuvaci'])){
            return view('site.not_access', ['user' => Auth::user()]);
        }

        $users = User::all();

        $roles = Roles::all();

        return view('users.index', ['users' => $users, 'access' => $access, 'roles' => $roles]);
    }

    public function store(Request $request){

        $role = Roles::find($request->role);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->access = $role->values;
        $user->password = bcrypt(Str::random(10));
        $user->save();

        Mail::send('auth.usercreate', ['data' => $request], function($message) use ($request){
           $message->from('no-reply@amg.dosolution.top', 'AMG');
           $message->subject('Ваш акаунт створено');
           $message->to($request->email);
        });

        $from_likar = new FromLikar();
        $from_likar->name = $user->name;
        $from_likar->user_id = $user->id;
        $from_likar->date_add = date("Y-m-d", time());
        $from_likar->save();

        $users = User::all();

        return view('users.part', ['users' => $users]);
    }

    public function edit($id){

        $user = User::find($id);

        $roles = Roles::all();

        if(!in_array('write', json_decode(Auth::user()->access, true)['koristuvaci'])){
            return view('site.not_access', ['user' => $user]);
        }
        $pages = Pages::all();

        $specialists = Specialists::all();

        return view('users.edit', ['user' => $user, 'pages' => $pages, 'roles' => $roles, 'specialists' => $specialists]);
    }

    public function update(Request $request, $id){
        $user = User::find($id);

        $role = Roles::find($request->role);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->access = $role->values;
        $user->save();

        return redirect()->route('users.edit', ['id' => $id]);
    }

    public function update_access(Request $request, $id){

        $user = User::find($id);

        $pages = Pages::all();

        $data = $request->except('_token');

        foreach($pages as $page){
            $alias = $page->alias;
            if(isset($data[$alias])){
                $access[$alias] = $data[$alias];
            }
        }
        if(isset($access)){
            $uaccess = json_encode($access);
        }
        $user->access = $uaccess;
        $user->save();

        return true;
    }

    public function add_specialist(Request $request, $id){

        $specialist = LikarSpecialists::where('user_id', $id)->where('specialist_id', $request->specialist)->first();
        if(!$specialist){
            $specialist = new LikarSpecialists();
            $specialist->user_id = $id;
            $specialist->specialist_id = $request->specialist;
            $specialist->timing = $request->timing;
            $specialist->save();

            $specialists = LikarSpecialists::where('user_id', $id)->get();

            return view('users.specialist_part', ['specialists' => $specialists]);
        }
    }

    public function del_specialist($id){

        $specialist = LikarSpecialists::find($id);
        $user = $specialist->user_id;
        $specialist->delete();

        $specialists = LikarSpecialists::where('user_id', $user)->get();

        return view('users.specialist_part', ['specialists' => $specialists]);

    }
}
