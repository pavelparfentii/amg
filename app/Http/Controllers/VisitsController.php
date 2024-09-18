<?php

namespace App\Http\Controllers;

use App\Models\Cabinets;
use App\Models\FromLikar;
use App\Models\PromoServices;
use App\Models\Service;
use App\Models\User;
use App\Models\VisitInfo;
use App\Models\VisitorBalances;
use App\Models\Visitors;
use App\Models\VisitPays;
use App\Models\Visits;
use App\Models\VisitServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Models\VisitNotes;
use Illuminate\Support\Facades\Session;
use App\Models\Files;
use ZipStream\File;

class VisitsController extends Controller
{
    public function precreate($date, $cabinet, $time){
        $creater = Auth::user()->id;

        $visit = Visits::where('date', $date)->where('cabinet', $cabinet)->where('time', $time)->first();
        if(!$visit){
            $visit = new Visits();
            $visit->block_time = time();
            $visit->creater_id = $creater;
            $visit->date = $date;
            $visit->cabinet = $cabinet;
            $visit->time = $time;
            $visit->status = 'block';
            $visit->timing = 4;
            $visit->save();

            return redirect()->route('visits.create', ['visit' => $visit->id]);
        }
        else{
            if($visit->status == 'block'){
                if($visit->creater_id != $creater){
                    if(($visit->block_time + 600) < time()){
                        $visit->creater_id = $creater;
                        $visit->block_time = time();
                        $visit->save();

                        return redirect()->route('visits.create', ['visit' => $visit->id]);
                    }
                    else{
                        return redirect()->route('site.index');
                    }
                }
                else{
                    return redirect()->route('visits.create', ['visit' => $visit->id]);
                }
            }
            else{
                return redirect()->route('site.index');
            }
        }
    }

    public function create($visit){

        $visit = Visits::find($visit);

        $likars = User::where('role_id', '3')->get();

        $from_likars = FromLikar::where('active', '1')->orderBy('name', 'asc')->get();

        return view('visits.create', ['visit' => $visit, 'likars' => $likars, 'from_likars' => $from_likars]);
    }

    public function pretiming(Request $request, $visit){

        $visit = Visits::find($visit);

        $timegrid = $request->pips/15;
        for($i=1;$i<=$timegrid;$i++){
            $pretime = $visit->time.":00";
            $istime = Carbon::parse($visit->time);
            $istime->format('H:i');
            $newtime = $istime->addMinutes(15*$i);
            //$newtime->format("H:i");
            $ivisit = Visits::where('date', $visit->date)
                ->where('cabinet', $visit->cabinet)
                ->where('time', $newtime)
                ->first();

            if(!$ivisit){
                $error = false;
            }
            else{
                $error = 1;
            }
        }
        if(!$error){
            $visit->timing = $timegrid;
            $visit->save();
        }
        else{
            return 'Час зайнятий';
        }
    }

    public function store(Request $request, $id){

        $visit = Visits::find($id);

        if(!$request->visitor){
            $visitNote = new VisitNotes();
            $visitNote->visit_id = $id;
            $note['last_name'] = $request->last_name;
            $note['first_name'] = $request->first_name;
            $note['middle_name'] = $request->middle_name;
            $note['full_name'] = $request->last_name ." ".$request->first_name." ". $request->middle_name;
            $note['phone'] = $request->phone;
            $note['male'] = $request->male;
            $visitNote->value = json_encode($note);
            $visitNote->save();
        }
        else{
            $visit->visitor_id = $request->visitor;
        }
        $visit->from_likar = $request->from_likar;
        $visit->likar = $request->likar;
        $visit->patient = $request->patient;
        $visit->status = 'new';
        $visit->description = $request->description;
        $visit->save();

        return redirect()->route('site.index');
    }

    public function edit($visit){

        $visit = Visits::find($visit);

        if(!$visit->visitor_id){
            return redirect()->route('visitors.new_visit', ['visit' => $visit]);
        }
        else{
            $likars = User::where('role_id', '3')->get();

            $from_likars = FromLikar::where('active', '1')->orderBy('name', 'asc')->get();

            return view('visits.edit', ['visit' => $visit, 'likars' => $likars, 'from_likars' => $from_likars]);
        }
    }

    public function update(Request $request, $visit){

        $visit = Visits::find($visit);

        $visit->likar = $request->likar;
        $visit->from_likar = $request->from_likar;
        $visit->patient = $request->patient;
        $visit->description = $request->description;
        $visit->save();

        return redirect()->route('site.index');
    }

    public function to_visited($visit){

        $visit = Visits::find($visit);

        if($visit){
            if($visit->status == 'new'){
                $visit->status = 'visited';
                $visit->save();
            }
        }

        return redirect()->route('site.index');
    }

    public function add_services($visit){

        $visit = Visits::find($visit);

        return view('visits.add_services', ['visit' => $visit]);
    }

    public function service_add(Request $request, $visit){

        $visit = Visits::find($visit);

        if($visit->visitor->promo){
            foreach($visit->visitor->promo as $prom){
                $promo = PromoServices::where('promo_id', $prom->id)->where('service_id', $request->service)->first();
            }
        }

        if($request->service){
            $vservice = VisitServices::where('visit_id', $visit->id)->where('service_id', $request->service)->first();
            if($visit->patient=='0'){
                $service = Service::find($request->service);
                if($service->cost > 0){
                    $price = $service->cost;
                }
                else{
                    $price = $service->price;
                }
                if(!$vservice){
                    $vservice = new VisitServices();
                    $vservice->visit_id = $visit->id;
                    $vservice->service_id = $request->service;
                    $vservice->count = $request->count;
                    $vservice->price = $price;
                    $vservice->summa = round($request->count * $price, 0);
                }
                else{
                    $vservice->count += $request->count;
                    $vservice->price = $price;
                    $vservice->summa = round($request->count * $price, 0);
                }
            }
            else{
                if(!$vservice){
                    $vservice = new VisitServices();
                    $vservice->visit_id = $visit->id;
                    $vservice->service_id = $request->service;
                    $vservice->count = $request->count;
                    if($request->discount_percent){
                        $discount = round($request->price * $request->discount_percent/100, 0);
                    }
                    elseif($request->discount_absolute){
                        $discount = $request->discount_absolute;
                    }
                    $vservice->price = $request->price;
                    if(isset($discount)){
                        $discount = $discount;
                    }
                    else{
                        $discount = 0;
                    }
                    $vservice->discount = $discount;
                    $vservice->summa = $request->count * round($request->price - $discount, 0);
                }
                else{
                    $vservice->count += $request->count;
                    $vservice->summa = ($vservice->price - $vservice->discount) * ($vservice->count + $request->count);
                }
            }
            $vservice->save();
        }

        $visit = Visits::find($visit->id);

        return view('visits.services_part', ['visit' => $visit]);
    }

    public function service_del(Request $request, $visit){

        $service = VisitServices::find($request->id);
        $service->delete();

        $visit = Visits::find($visit);

        return view('visits.services_part', ['visit' => $visit]);
    }

    public function to_pay(Request $request, $visit){

        $visit = Visits::find($visit);

        $suma_pay = (isset($request->cash) ? $request->cash : 0)
            + (isset($request->card) ? $request->card : 0)
            + (isset($request->invoice) ? $request->invoice : 0)
            + (isset($request->balance) ? $request->balance : 0);
        if($visit->cost() >= $suma_pay){
            if($request->balance){
                if($request->balance && $visit->visitor->balances() >= $request->balance){
                    $vpay = new VisitPays();
                    $vpay->visit_id = $visit->id;
                    $vpay->pay_type = 'balance';
                    $vpay->summa = $request->balance;
                    $vpay->date = date('Y-m-d', time());
                    $vpay->creater_id = Auth::user()->id;
                    $vpay->save();

                    $bal = new VisitorBalances();
                    $bal->visitor_id = $visit->visitor_id;
                    $bal->summa = "-".$request->balance;
                    $bal->date = date("Y-m-d", time());
                    $bal->save();
                }
            }
            if($request->cash){
                $vpay = new VisitPays();
                $vpay->visit_id = $visit->id;
                $vpay->pay_type = 'cash';
                $vpay->summa = $request->cash;
                $vpay->date = date('Y-m-d', time());
                $vpay->creater_id = Auth::user()->id;
                $vpay->save();
            }
            if($request->card){
                $vpay = new VisitPays();
                $vpay->visit_id = $visit->id;
                $vpay->pay_type = 'card';
                $vpay->summa = $request->card;
                $vpay->date = date('Y-m-d', time());
                $vpay->creater_id = Auth::user()->id;
                $vpay->save();
            }
            if($request->invoice){
                $vpay = new VisitPays();
                $vpay->visit_id = $visit->id;
                $vpay->pay_type = 'invoice';
                $vpay->summa = $request->invoice;
                $vpay->date = date('Y-m-d', time());
                $vpay->creater_id = Auth::user()->id;
                $vpay->save();
            }

            if($visit->cost() > $visit->pays->sum('summa') && $visit->pays->sum('summa') != 0){
                $visit->status = 'partpayed';
                $visit->save();
                return redirect()->route('visits.add_services', ['visit' => $visit]);
            }
            {
                $visit->status = 'payed';
                $visit->save();
                return redirect()->route('visits.show', ['visit' => $visit]);
            }
        }
        return redirect()->back()->withErrors(['message' => 'Сума послуг менше ніж оплата']);
    }

    public function show($visit){

        $visit = Visits::find($visit);

        $files = Files::where('visit_id', $visit->id)->get();

        return view('visits.show', ['visit' => $visit, 'files' => $files]);
    }

    public function priem($visit){

        $visit = Visits::find($visit);
        if($visit->likar != Auth::user()->id){
            return redirect()->route('site.likar_calendar');
        }
        else{
            $user = User::find(Auth::user()->id);
        }

        return view('visits.priem', ['visit' => $visit, 'user' => $user]);
    }

    public function info_store(Request $request){

        $info = VisitInfo::where('visit_id', $request->visit)->where('specialist', $request->specialist)->where('form', $request->form)->first();
        if(!$info) {
            $info = new VisitInfo();
            $info->visit_id = $request->visit;
            $info->specialist = $request->specialist;
            $info->form = $request->form;
        }
        $input = $request->except(['_token', 'visit', 'specialist', 'form']);
        $data = json_encode($input, JSON_UNESCAPED_UNICODE);
        $info->value = $data;
        $info->save();

        return route('visits.form_print', ['specialist' => $request->specialist, 'form' => $request->form, 'visit' => $request->visit]);
    }

    public function destroy($visit){
        $visit = Visits::find($visit);
        if($visit->status == 'new'){
            $visit->services()->delete();
            $visit->delete();
        }

        return redirect()->route('site.index');
    }

    public function to_date($visit){

        $visit = Visits::find($visit);

        $likars = User::where('role_id', '3')->get();

        $cabinets = Cabinets::where('active', true)->get();

        $startTime = Carbon::parse('09:00:00');

        $endTime = Carbon::parse('19:00:00');

        $timeGrid = [];

        while ($startTime <= $endTime) {
            $timeGrid[] = $startTime->format('H:i');
            $startTime->addMinutes(15);
        }

        $visitData = array();
        $visits = Visits::where('date', $visit->date)->where('cabinet', $visit->cabinet)->get();

        foreach($visits as $visit){
            $visitData[$visit->time] = $visit;
        }
        return view('visits.to_date', ['visit' => $visit, 'likars' => $likars, 'cabinets' => $cabinets, 'timeGrid' => $timeGrid, 'visitData' => $visitData]);
        //return redirect()->route('site.index');
    }

    public function reopen($visit){

        $visit = Visits::find($visit);
        $visit->status = 'visited';
        $visit->save();

        return redirect()->route('visits.add_services', ['visit' => $visit]);
    }

    public function reopen_v($visit){

        $visit = Visits::find($visit);

            $visit->status = "new";
            $visit->save();

            Session::put('date', $visit->date);

            return redirect()->route('site.index');

    }

    public function list($date, $cabinet){

        $cabinets = Cabinets::find($cabinet);

        $startTime = Carbon::parse('09:00:00');

        $endTime = Carbon::parse('19:00:00');

        $timeGrid = [];

        while ($startTime <= $endTime) {
            $timeGrid[] = $startTime->format('H:i');
            $startTime->addMinutes(15);
        }

        $visitData = array();
        $visits = Visits::where('date', $date)->where('cabinet', $cabinet)->get();

        foreach($visits as $visit){
            $visitData[$visit->time] = $visit;
        }

        return view('visits.list', ['visitData' => $visitData, 'cabinets' => $cabinets, 'timeGrid' => $timeGrid]);
    }

    public function to_date_store(Request $request, $visit){

        $visit = Visits::find($visit);

        if($request->date){
            $visit->date = $request->date;
            $visit->time = $request->time;
            $visit->cabinet = $request->cabinet;
            $visit->likar = $request->likar;
            $visit->save();

            Session::put('date', $request->date);

            return redirect()->route('site.index');
        }
    }

    public function pay_delete(Request $request, $visit){

        $visit = Visits::find($visit);

        $pays = VisitPays::where('visit_id', $visit->id)
            ->where('pay_type', $request->pay_type);

        if($pays){
            if($request->pay_type=='balance'){
                $balance = new VisitorBalances();
                $balance->visitor_id = $visit->visitor_id;
                $balance->summa = $pays->sum('summa');
                $balance->date = date('Y-m-d', time());
                $balance->save();
            }
            $pays->delete();
        }

        $to_pay = round($visit->cost() - $visit->pays->sum('summa'), 2);

        return $to_pay;
    }

    public function print_analize($visit){

        $visit = Visits::find($visit);

        return view('visits.forms.analize', ['visit' => $visit]);
    }

    public function upload_analize(Request $request, $visit){

        if($request->hasFile('file')) {
            $files = $request->file('file');
            if(!is_dir(public_path().'/upload/analize/' . $visit)){
                mkdir(public_path().'/upload/analize/' . $visit);
            }
            foreach($files as $file){
                $extension = $file->extension();
                $filename = time().".".$extension;
                $file->move(public_path().'/upload/analize/'.$visit, $filename);

                $fileBase = new Files();
                $fileBase->visit_id = $visit;
                $fileBase->date = date("Y-m-d");
                $fileBase->file = $filename;
                $fileBase->title = $file->getClientOriginalName();
                $fileBase->user_id = Auth::user()->id;
                $fileBase->save();

            }
        }
        return redirect()->back()->with(['message' => 'Файл завантажено']);
    }

    public function history_show($id){
        $visit = Visits::find($id);

        if($visit->info){
            return redirect()->route('visits.form_print', ['specialist' => $visit->info->specialist, 'form' => $visit->info->form, 'visit' => $visit]);
        }
        else{
            return redirect()->back();
        }
    }

}
