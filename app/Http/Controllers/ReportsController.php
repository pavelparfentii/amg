<?php

namespace App\Http\Controllers;

use App\Models\VisitPays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportsController extends Controller
{
    public function services_period(Request $request){
        return 'development in progress';
    }

    public function doctor_period(Request $request){
        return 'development in progress';
    }

    public function pay_period(Request $request){

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

        $pays = VisitPays::whereBetween('date', array($from, $to))->get();

        $list = array();
        $summa_cash = 0;
        $summa_card = 0;
        $summa_invoice = 0;
        $summa_balance = 0;

        foreach($pays as $pay){
            if(empty($list[$pay->visit_id])){
                $list[$pay->visit_id]['visit_id'] = $pay->visit_id;
                $list[$pay->visit_id]['date'] = date("d.m.Y", strtotime($pay->date));
                $list[$pay->visit_id]['visitor_id'] = $pay->visit->visit_id;
                $list[$pay->visit_id]['full_name'] = $pay->visit->visitor->full_name;
                $list[$pay->visit_id]['visit_cost'] = $pay->visit->cost();
                if($pay->pay_type == 'cash') {
                    $list[$pay->visit_id]['cash'] = $pay->summa;
                    $summa_cash += $pay->summa;
                }
                if($pay->pay_type == 'card') {
                    $list[$pay->visit_id]['card'] = $pay->summa;
                    $summa_card += $pay->summa;
                }
                if($pay->pay_type == 'invoice') {
                    $list[$pay->visit_id]['invoice'] = $pay->summa;
                    $summa_invoice += $pay->summa;
                }
                if($pay->pay_type == 'balance') {
                    $list[$pay->visit_id]['balance'] = $pay->summa;
                    $summa_balance += $pay->summa;
                }
            }
            else{
                if($pay->pay_type == 'cash') {
                    if(isset($list[$pay->visit_id]['cash'])) {
                        $list[$pay->visit_id]['cash'] += $pay->summa;
                        $summa_cash += $pay->summa;
                    }
                    else{
                        $list[$pay->visit_id]['cash'] = $pay->summa;
                        $summa_card += $pay->summa;
                    }
                }
                if($pay->pay_type == 'card') {
                    if(isset($list[$pay->visit_id]['card'])) {
                        $list[$pay->visit_id]['card'] += $pay->summa;
                        $summa_cash += $pay->summa;
                    }
                    else{
                        $list[$pay->visit_id]['card'] = $pay->summa;
                        $summa_card += $pay->summa;
                    }
                }
                if($pay->pay_type == 'invoice') {
                    if(isset($list[$pay->visit_id]['invoice'])) {
                        $list[$pay->visit_id]['invoice'] += $pay->summa;
                        $summa_invoice += $pay->summa;
                    }
                    else{
                        $list[$pay->visit_id]['invoice'] = $pay->summa;
                        $summa_invoice += $pay->summa;
                    }
                }
                if($pay->pay_type == 'balance') {
                    if(isset($list[$pay->visit_id]['balance'])) {
                        $list[$pay->visit_id]['balance'] += $pay->summa;
                        $summa_balance += $pay->summa;
                    }
                    else{
                        $list[$pay->visit_id]['balance'] = $pay->summa;
                        $summa_balance += $pay->summa;
                    }
                }
            }
        }
        //dd($list);
        return view('reports.pays', ['from' => $from, 'to' => $to, 'list' => $list, 'summa_cash' => $summa_cash, 'summa_card' => $summa_card, 'summa_invoice' => $summa_invoice, 'summa_balance' => $summa_balance]);
    }
}
