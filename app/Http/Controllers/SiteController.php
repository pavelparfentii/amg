<?php

namespace App\Http\Controllers;

use App\Models\Cabinets;
use App\Models\Visits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SiteController extends Controller
{
    public function index(Request $request){
        if($request->date){
            Session::put('date', $request->date);
        }
        if(Session::has('date')) {
            $date = Session::get('date');
        }
        else {
            $date = date("Y-m-d", time()); //Дата от
            Session::put('date', $date);
        }

        if(json_decode(Auth::user()->access, true)){
            if(isset(json_decode(Auth::user()->access, true)['zapis-pacijentiv'])){
                if(!in_array('create', json_decode(Auth::user()->access, true)['zapis-pacijentiv'])){
                    return redirect()->route('site.likar_calendar');
                }
            }
            else{
                return redirect()->route('site.likar_calendar');
            }
        }
        else{
            return redirect()->route('site.likar_calendar');
        }
        $visitData = array();

        $cabinets = Cabinets::where('active', true)->get();

        $startTime = Carbon::parse('09:00:00');

        $endTime = Carbon::parse('19:00:00');

        $timeGrid = [];

        while ($startTime <= $endTime) {
            $timeGrid[] = $startTime->format('H:i');
            $startTime->addMinutes(15);
        }

        $visits = Visits::where('date', $date)->get();

        foreach($visits as $visit){
            $visitData[$visit->time][$visit->cabinet] = $visit;
        }
        return view('site.index', ['date' => $date, 'cabinets' => $cabinets, 'timeGrid' => $timeGrid, 'visitData' => $visitData]);
    }

    public function date_refresh(Request $request){
        if($request->date){
            Session::put('date', $request->date);
        }
        return true;
    }

    public function likar_calendar(Request $request){
        if($request->date){
            Session::put('date', $request->date);
        }
        if(Session::has('date')) {
            $date = Session::get('date');
        }
        else {
            $date = date("Y-m-d", time()); //Дата от
            Session::put('date', $date);
        }

        $visitData = array();

        $startTime = Carbon::parse('09:00:00');

        $endTime = Carbon::parse('19:00:00');

        $timeGrid = [];

        while ($startTime <= $endTime) {
            $timeGrid[] = $startTime->format('H:i');
            $startTime->addMinutes(15);
        }

        $visits = Visits::where('date', $date)->where('likar', Auth::user()->id)->get();

        foreach($visits as $visit){
            $visitData[$visit->time] = $visit;
        }

        return view('site.likar_calendar', ['date' => $date, 'timeGrid' => $timeGrid, 'visitData' => $visitData]);
    }
}
