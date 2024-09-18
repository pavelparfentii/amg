<?php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use App\Models\Items;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ItemsController extends Controller
{

    public function index(){

        $items = Items::orderBy('name', 'asc')->get();

        $groups = ItemGroup::where('active', true)->get();

        return view('items.index', ['items' => $items, 'groups' => $groups]);
    }

    public function groups(){

        $groups = ItemGroup::orderBy('name', 'asc')->get();

        return view('item_groups.index', ['groups' => $groups]);
    }

    public function group_store(Request $request){

        if($request->name){
            $group = new ItemGroup();
            $group->name = $request->name;
            $group->alias = Str::slug($request->name);
            $group->active = $request->active;
            $group->save();
        }

        $groups = ItemGroup::orderBy('name', 'asc')->get();

        return view('item_groups.groups_part', ['groups' => $groups]);
    }

    public function group_edit($group){

        $group = ItemGroup::find($group);

        return view('item_groups.group_edit', ['group' => $group]);
    }

    public function group_update(Request $request, $group){
        $group = ItemGroup::find($group);
        $group->name = $request->name;
        $group->alias = Str::slug($request->name);
        $group->active = $request->active;
        $group->save();

        $groups = ItemGroup::orderBy('name', 'asc')->get();

        return view('item_groups.groups_part', ['groups' => $groups]);
    }

    public function groupsBy($id){
        $groupBy = ItemGroup::find($id);

        $items = Items::where('group_id', $id)->orderBy('name', 'asc')->get();

        return view('items.index', ['groupBy' => $groupBy, 'items' => $items]);
    }

    public function store(Request $request){

        $item = new Items();
        $item->name = $request->name;
        $item->alias = Str::slug($request->name);
        $item->group_id = $request->parent;
        $item->active = $request->active;
        $item->save();

        $items = Items::orderBy('name', 'asc')->get();

        return view('items.items_part', ['items' => $items]);
    }

    public function edit($id){
        $item = Items::find($id);

        $groups = ItemGroup::where('active', true)->get();

        return view('items.edit', ['item' => $item, 'groups' => $groups]);
    }

    public function update(Request $request, $id){

        $item = Items::find($id);
        $item->name = $request->name;
        $item->alias = Str::slug($request->name);
        $item->group_id = $request->parent;
        $item->active = $request->active;
        $item->save();

        $items = Items::orderBy('name', 'asc')->get();

        return view('items.items_part', ['items' => $items]);

    }

    public function itemSearch(Request $request){
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = Items::select("id","name")
                ->where('name', 'LIKE', "%$search%")
                ->orwhere('id', 'LIKE', "%$search%")
                ->get();
        }

        return response()->json($data);
    }

    public function lastPrice($id){

        $price = false;
        $price = OrderItem::select('price')
            ->where('item_id', $id)
            ->whereIn('order_id', function($query){
                $query->select('id')->from('orders')->where('order_type', 'in');
            })
            ->orderBy('id', 'desc')
            ->first();

        return $price;
    }

    public function leftovers(){

        $items = Items::where('active', true)->get();

        return view('items.leftovers', ['items' => $items]);
    }

    public function pivot(Request $request){

        if($request->from){
            Session::put('from', $request->from);
        }
        if(Session::has('from')) {
            $from = Session::get('from');
        }
        else {
            $from = date("Y-m-d", time()); //Дата от
            Session::put('from', $from);
        }
        if($request->to){
            Session::put('to', $request->to);
        }
        if(Session::has('to')) {
            $to = Session::get('to');
        }
        else {
            $to = date("Y-m-d", time()); //Дата от
            Session::put('to', $to);
        }

        $items = Items::where('active', true)->get();

        $list = array();

        foreach($items as $item){
            $list[$item->id]['name'] = $item->name;
            $list[$item->id]['saldo_in'] = OrderItem::where('item_id', $item->id)->where('order_id', function($query) use($from){
                $query->select('id')->from('orders')->where('date', '<=', $from);
            })->sum('count');
            $list[$item->id]['in'] = OrderItem::where('item_id', $item->id)->where('order_id', function($query) use($from, $to){
                $query->select('id')->from('orders')->whereBetween('date', array($from, $to))->where('order_type', 'in');
            })->sum('count');
            $list[$item->id]['out'] = OrderItem::where('item_id', $item->id)->where('order_id', function($query) use($from, $to){
                $query->select('id')->from('orders')->whereBetween('date', array($from, $to))->where('order_type', 'out');
            })->sum('count');
        }
        return view('items.pivot', ['from' => $from, 'to' => $to, 'items' => $items, 'list' => $list]);
    }
}
