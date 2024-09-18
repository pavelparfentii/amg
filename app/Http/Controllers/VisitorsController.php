<?php

namespace App\Http\Controllers;

use App\Models\PrintForms;
use App\Models\Promo;
use App\Models\PromoVisitor;
use App\Models\VisitNotes;
use App\Models\VisitorBalances;
use App\Models\Visitors;
use App\Models\Visits;
use Illuminate\Http\Request;
use Auth;

class VisitorsController extends Controller
{
    public function index(){

        if(json_decode(Auth::user()->access, true)){
            if(!in_array('read', json_decode(Auth::user()->access, true)['pacijenti'])){
                return view('site.not_access', ['user' => Auth::user()]);
            }
        }
        else{
            return view('site.not_access', ['user' => Auth::user()]);
        }

        $visitors = Visitors::all();

        return view('visitors.index', ['visitors' => $visitors]);
    }

    public function edit($id){

        $visitor = Visitors::find($id);

        $promos = Promo::where('active', '1')->get();

        return view('visitors.edit', ['visitor' => $visitor, 'promos' => $promos]);
    }

    public function update(Request $request, $visitor){

        $visitor = Visitors::find($visitor);

        $visitor->first_name = $request->first_name;
        $visitor->last_name = $request->last_name;
        $visitor->middle_name = $request->middle_name;
        $visitor->full_name = $request->last_name . " " . $request->first_name . " " . $request->middle_name;
        $visitor->birthday = $request->birthday;
        $visitor->male = $request->male;
        $visitor->phone = $request->phone;
        $visitor->second_phone = $request->second_phone;
        $visitor->email = $request->email;
        $visitor->adress = $request->adress;
        $visitor->description = $request->description;
        $visitor->date_add = date("Y-m-d", time());
        $visitor->save();

        return true;
    }

    public function new_visit($visit){

        $visit = Visits::find($visit);

        return view('visitors/new_visitor', ['visit' => $visit]);
    }

    public function new_store(Request $request, $visit){

        $visitor = new Visitors();
        $visitor->last_name = $request->last_name;
        $visitor->first_name = $request->first_name;
        $visitor->middle_name = $request->middle_name;
        $visitor->full_name = $request->last_name . " " . $request->first_name . " " . $request->middle_name;
        $visitor->birthday = $request->birthday;
        $visitor->male = $request->male;
        $visitor->phone = $request->phone;
        $visitor->second_phone = $request->second_phone;
        $visitor->email = $request->email;
        $visitor->adress = $request->adress;
        $visitor->description = $request->description;
        $visitor->date_add = date("Y-m-d", time());
        $visitor->save();

        $visit = Visits::find($visit);
        $visit->visitor_id = $visitor->id;
        $visit->status = 'visited';
        $visit->save();

        $note = VisitNotes::where('visit_id', $visit->id)->first();
        $note->delete();

        return redirect()->route('visitors.print', ['visitor' => $visitor->id]);
    }

    public function print($visitor){

        $visitor = Visitors::find($visitor);

        $forms = PrintForms::where('type', 'kartka')->get();

        return view('visitors.print', ['visitor' => $visitor, 'forms' => $forms]);

    }

    public function reprint(Request $request, $visitor){

        $visitor = Visitors::find($visitor);

        return view('visitors.reprint', ['visitor' => $visitor, 'forms' => $request->forms]);
    }

    public function select2ajax(Request $request){

        if($request->has('q')){
            $search = $request->q;
            $data = Visitors::select("id","full_name","phone","birthday")
                ->where('full_name', 'LIKE', "%$search%")
                ->orwhere('id', 'LIKE', "%$search%")
                ->orwhere('phone', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function promo_add(Request $request, $visitor){

        $promo = PromoVisitor::where('visitor_id', $visitor)
            ->where('promo_id', $request->promo)
            ->first();

        if(!$promo){
            $promo = new PromoVisitor();
            $promo->visitor_id = $visitor;
            $promo->promo_id = $request->promo;
            $promo->date_add = date('Y-m-d', time());
            $promo->save();
        }

        $promos = PromoVisitor::where('visitor_id', $visitor)->get();

        return view('visitors.promo_table', ['promos' => $promos]);
    }

    public function balance_add(Request $request, $visitor){

        $balance = new VisitorBalances();
        $balance->visitor_id = $visitor;
        $balance->summa = $request->summa;
        $balance->date = date("Y-m-d", time());
        $balance->save();

        $vbalance = VisitorBalances::where('visitor_id', $visitor)->sum('summa');

        return $vbalance." грн.";
    }
}
