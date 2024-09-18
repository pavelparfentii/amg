<?php

namespace App\Http\Controllers;

use App\Models\Cabinets;
use App\Models\CabinetsLikar;
use App\Models\FromLikar;
use App\Models\Pages;
use App\Models\Specialists;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function times(){

    }

    public function pages(){

        $pages = Pages::all();

        return view('pages.index', ['pages' => $pages]);
    }

    public function page_create(){

        return view('pages.create');
    }

    public function pages_store(Request $request){

        $page = new Pages();
        $page->name = $request->name;
        $page->alias = Str::slug($request->name);
        $page->url = $request->url;
        $page->save();

        $pages = Pages::all();

        return view('pages.part', ['pages' => $pages]);
    }

    public function specialists(){

        $specialists = Specialists::all();

        return view('specialists.index', ['specialists' => $specialists]);

    }

    public function specialists_store(Request $request){

        $specialist = new Specialists();
        $specialist->name = $request->name;
        $specialist->alias = Str::slug($request->name);
        $specialist->save();

        $specialists = Specialists::all();

        return view('specialists.part', ['specialists' => $specialists]);
    }

    public function cabinets(){

        $cabinets = Cabinets::all();

        return view('cabinets.index', ['cabinets' => $cabinets]);
    }

    public function cabinets_store(Request $request){

        $specialist = new Cabinets();
        $specialist->name = $request->name;
        $specialist->alias = Str::slug($request->name);
        $specialist->custom = $request->custom;
        $specialist->save();

        $cabinets = Cabinets::all();

        return view('cabinets.part', ['cabinets' => $cabinets]);
    }

    public function cabinet_edit($id){

        $cabinet = Cabinets::find($id);

        $likars = User::where('role_id', '3')->orWhere('role_id', '5')->get();

        $cabinet_likars = CabinetsLikar::where('cabinet_id', $id)->get();

        return view('cabinets.edit', ['cabinet' => $cabinet, 'likars' => $likars, 'cabinet_likars' => $cabinet_likars]);
    }

    public function cabinet_update(Request $request, $id){

        $cabinet = Cabinets::find($id);

        $cabinet->name = $request->name;
        $cabinet->active = $request->active;
        $cabinet->custom = $request->custom;
        $cabinet->save();

        return redirect()->route('settings.cabinet_edit', ['id' => $id]);
    }

    public function cabinets_likar_add(Request $request, $id){

        $likar = CabinetsLikar::where('cabinet_id', $id)->where('user_id', $request->specialist)->first();
        if(!$likar){
            $likar = new CabinetsLikar();
            $likar->cabinet_id = $id;
            $likar->user_id = $request->specialist;
            $likar->save();
        }

        $cabinet_likars = CabinetsLikar::where('cabinet_id', $id)->get();

        return view('cabinets.likar_part', ['cabinet_likars' => $cabinet_likars]);
    }

    public function cabinets_likar_del(Request $request){
        $likar = CabinetsLikar::find($request->id);
        $cabinet = $likar->cabinet_id;
        CabinetsLikar::destroy($request->id);

        $cabinet_likars = CabinetsLikar::where('cabinet_id', $cabinet)->get();

        return view('cabinets.likar_part', ['cabinet_likars' => $cabinet_likars]);
    }

    public function cabinets_likar($cabinet){

        $likars = CabinetsLikar::where('cabinet_id', $cabinet)->get();

        return view('cabinets.cabinet_likar', ['likars' => $likars]);
    }

    public function likars(){

        $likars = FromLikar::all();

        $users = User::all();

        return view('settings.from_likars', ['likars' => $likars, 'users' => $users]);
    }

    public function from_likars_store(Request $request){

        $likar = new FromLikar();
        $likar->name = $request->name;
        $likar->address = $request->address;
        $likar->user_id = $request->user;
        $likar->active = $request->active;
        $likar->description = $request->description;
        $likar->date_add = date("Y-m-d", time());
        $likar->save();

        $likars = FromLikar::all();

        return view('settings.from_likars_part', ['likars' => $likars]);
    }

}
