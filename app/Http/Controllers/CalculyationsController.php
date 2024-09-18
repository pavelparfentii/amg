<?php

namespace App\Http\Controllers;

use App\Models\Calculyation;
use App\Models\CalculyationItem;
use Illuminate\Http\Request;

class CalculyationsController extends Controller
{
    public function index(){

        $items = Calculyation::orderBy('name', 'asc')->get();

        return view('calculyations.index', ['items' => $items]);
    }

    public function create(){

        return view('calculyations.create');
    }

    public function store(Request $request){

        $calc = new Calculyation();
        $calc->service_id = $request->service;
        $calc->name = $request->name;
        if($request->pf){
            $calc->is_pf = '1';
        }
        else{
            $calc->is_pf = '0';
        }
        $calc->date_add = date("Y-m-d", time());
        $calc->date_start = $request->date_start;
        $calc->active = '1';
        $calc->save();

        return redirect()->route('calculyations.edit', ['id' => $calc->id]);
    }

    public function edit($id){

        $calc = Calculyation::find($id);

        return view('calculyations.edit', ['calc' => $calc]);
    }

    public function update(Request $request, $id){

    }

    public function add_item(Request $request, $id){

        $item = CalculyationItem::where('item_id', $request->item)
            ->where('calculyation_id', $id)
            ->where('item_type', $request->item_type)
            ->first();
        if(!$item){
            $item = new CalculyationItem();
            $item->calculyation_id = $id;
            $item->item_id = $request->item;
            $item->count = $request->count;
            $item->price = $request->price;
            $item->item_type = $request->item_type;
            $item->save();
        }
        else{
            $item->count += $request->count;
            $item->save();
        }

        $items = CalculyationItem::where('calculyation_id', $id)->where('item_type', $request->item_type)->get();

        $calc = Calculyation::find($id);

        if($request->item_type == 'item'){
            return view('calculyations.items_table', ['items' => $items, 'calc' => $calc]);
        }

        if($request->item_type == 'pf'){
            return view('calculyations.pf_table', ['items' => $items, 'calc' => $calc]);
        }

        if($request->item_type == 'service'){
            return view('calculyations.service_table', ['items' => $items, 'calc' => $calc]);
        }

    }

    public function item_delete(Request $request){

    }

    public function inactive($id){

    }

    public function delete($id){

    }

    public function pfSearch(Request $request){
        if($request->has('q')){
            $search = $request->q;
            $data = Calculyation::select("id","name")
                ->where('is_pf', true)
                ->where('name', 'LIKE', "%$search%")
                ->orwhere('id', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function lastPrice($id){

        $calc = Calculyation::find($id);

        $price = $calc->summa();

        return $price;
    }
}
