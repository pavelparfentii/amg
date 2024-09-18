<?php

namespace App\Http\Controllers;

use App\Models\ContragentGroups;
use App\Models\Contragents;
use Illuminate\Http\Request;

class ContragentsController extends Controller
{
    public function index(){

        $items = Contragents::orderBy('name', 'asc')->get();

        $groups = ContragentGroups::where('active', true)->orderBy('name', 'asc')->get();

        return view('contragents.index', ['items' => $items, 'groups' => $groups]);
    }

    public function create(){

        return view('contragents.create');
    }

    public function store(Request $request){

        $item = new Contragents();
        $item->name = $request->name;
        $item->group = $request->group;
        $item->active = $request->active;
        $item->save();

        $items = Contragents::orderBy('name', 'asc')->get();

        return view('contragents.part', ['items' => $items]);
    }

    public function edit($id){

        $item = Contragents::find($id);

        $groups = ContragentGroups::where('active', true)->orderBy('name', 'asc')->get();

        return view('contragents.edit', ['item' => $item, 'groups' => $groups]);
    }

    public function update(Request $request, $id){

        $item = Contragents::find($id);
        $item->name = $request->name;
        $item->group = $request->group;
        $item->active = $request->active;
        $item->save();

        $items = Contragents::orderBy('name', 'asc')->get();

        return view('contragents.part', ['items' => $items]);

    }

    public function destroy($id){

        return redirect()->route('contragents.index');
    }

    public function group_index(){

        $groups = ContragentGroups::all();

        return view('contragents.group_index', ['groups' => $groups]);
    }

    public function group_store(Request $request){

        $group = new ContragentGroups();

        $group->name = $request->name;
        $group->active = $request->active;
        $group->save();

        $groups = ContragentGroups::orderBy('name', 'asc')->get();

        return view('contragents.group_part', ['groups' => $groups]);
    }

    public function group_edit($id){

        $item = ContragentGroups::find($id);

        return view('contragents.group_edit', ['item' => $item]);

    }

    public function group_update(Request $request, $id){

    }

    public function group_destroy($id){

    }
}
