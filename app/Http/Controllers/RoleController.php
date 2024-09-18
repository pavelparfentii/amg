<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;
use App\Models\Roles;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(){

        $roles = Roles::all();

        return view('roles.index', ['roles' => $roles]);
    }

    public function create_access(){
        $pages = Pages::all();

        return view('roles.access_create', ['pages' => $pages]);
    }
    public function store_access(Request $request){

        $data = $request->except('_token');

        $pages = Pages::all();

        foreach($pages as $page){
            $alias = $page->alias;
            if(isset($data[$alias])){
                $access[$alias] = $data[$alias];
            }
        }
        if(isset($access)){
            $uaccess = json_encode($access);
        }

        $role = new Roles();
        $role->name = $data['modalRoleName'];
        $role->alias = Str::slug($data['modalRoleName']);
        if(isset($uaccess)){
            $role->values = $uaccess;
        }
        $role->save();

        return redirect()->route('users_role.index');
    }

    public function edit_access($id){

        $role = Roles::find($id);

        $pages = Pages::all();

        return view('roles.access_edit', ['role' => $role, 'pages' => $pages]);
    }

    public function update_access(Request $request){

        $data = $request->except('_token');

        $role = Roles::find($data['id']);

        $pages = Pages::all();

        foreach($pages as $page){
            $alias = $page->alias;
            if(isset($data[$alias])){
                $access[$alias] = $data[$alias];
            }
        }
        $uaccess = json_encode($access);
        $role->name = $data['modalRoleName'];
        $role->values = $uaccess;
        $role->save();

        return true;

    }
}
