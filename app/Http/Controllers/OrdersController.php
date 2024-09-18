<?php

namespace App\Http\Controllers;

use App\Models\Contragents;
use App\Models\Items;
use App\Models\OrderItem;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class OrdersController extends Controller
{

    public function index(Request $request){

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

        $items = OrderItem::whereIn('order_id', function($query) use($from, $to){
            $query->select('id')->from('orders')->whereBetween('date', array($from, $to))->orderBy('date', 'asc');
        })->get();

        return view('orders.index', ['items' => $items, 'from' => $from, 'to' => $to]);
    }

    public function income_create(){

        $contragents = Contragents::where('active', true)->get();

        return view('orders.income_create', ['contragents' => $contragents]);
    }

    public function store(Request $request){

        $order = new Orders();
        $order->date = $request->date;
        $order->contragent_id = $request->contragent;
        $order->contragent_order = $request->contragent_order;
        $order->order_type = $request->order_type;
        $order->creater = Auth::user()->id;
        $order->save();

        return redirect()->route('orders.edit', ['id' => $order->id]);
    }

    public function edit($id){

        $order = Orders::find($id);

        $contragents = Contragents::where('active', true)->get();

        $items = Items::where('active', true)->get();

        if($order->order_type == 'in'){

            return view('orders.edit_in', ['order' => $order, 'contragents' => $contragents, 'items' => $items]);

        }

        if($order->order_type == 'out'){

            return view('orders.edit_out', ['order' => $order, 'items' => $items]);

        }
    }

    public function update(Request $request, $id){

        $order = Orders::find($id);
        $order->date = $request->date;
        $order->contragent_id = $request->contragent;
        $order->contragent_order = $request->contragent_order;
        $order->save();

        return redirect()->route('orders.index');

    }

    public function add_item_in(Request $request, $id){

        $item = OrderItem::where('order_id', $id)
            ->where('item_id', $request->item)->first();

        if(!$item){
            $item = new OrderItem();
            $item->order_id = $id;
            $item->item_id = $request->item;
            $item->count = $request->count;
            if($request->nds > '0'){
                $item->price = round($request->price * $request->nds, 2);
            }
            else{
               $item->price = $request->price;
            }
            if($request->nds > '0'){
                $item->summa = round($request->count * $request->price * $request->nds, 2);
            }
            else{
                $item->summa = round($request->count * $request->price, 2);
            }
            $item->exp = $request->exp;
            $item->save();
        }
        else{
            if($item->price == $request->price){
                $item->count += $request->count;
                $item->summa = round($item->price * $item->count, 2);
                $item->save();
            }
            else{
                $item = new OrdersItem();
                $item->order_id = $id;
                $item->item_id = $request->id;
                $item->count = $request->count;
                if($request->nds > '0'){
                    $item->price = round($request->price * $request->nds, 2);
                }
                else{
                    $item->price = $request->price;
                }
                if($request->nds > '0'){
                    $item->summa = round($request->count * $request->price * $request->nds, 2);
                }
                else{
                    $item->summa = round($request->count * $request->price, 2);
                }
                $item->exp = $request->exp;
                $item->save();
            }
        }

        //$calcs = CalculyationsItems::where('goods_id', $item_id)->update(['price' => $request->price]);

        $items = OrderItem::where('order_id', $id)->orderBy('id', 'desc')->get();

        return view('orders.table_in', ['items' => $items]);
    }

    public function del_item_in(Request $request){

        OrderItem::find($request->item)->delete();

        $items = OrderItem::where('order_id', $request->order)->orderBy('id', 'desc')->get();

        return view('orders.table_in', ['items' => $items]);

    }

    public function consumption_create(){

        return view('orders.consumption_create');
    }

    public function item_count(Request $request){

        $item = array();

        $orders = OrderItem::where('item_id', $request->item)->get();

        $item['count'] = $orders->sum('count');

        $item['price'] = $orders->max('price');

        return $item;
    }

    public function add_item_out(Request $request, $id){

        $item = OrderItem::where('order_id', $id)->where('item_id', $request->item)->first();
        if(!$item){
            $item = new OrderItem();
            $item->order_id = $id;
            $item->item_id = $request->item;
            $item->price = $request->price;
            $item->count = "-".$request->count;
            $item->summa = round($request->count * $request->price, 2);
            $item->save();
        }
        else{
            $item->count -= $request->count;
            $item->summa = round($request->count * $request->price, 2);
            $item->save();
        }

        $order = Orders::find($id);

        return view('orders.table_out', ['order' => $order]);
    }
}
