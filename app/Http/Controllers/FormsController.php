<?php

namespace App\Http\Controllers;

use App\Models\PrintForms;
use App\Models\Specialists;
use App\Models\VisitInfo;
use App\Models\Visits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormsController extends Controller
{
    public function index(){

        $forms = PrintForms::all();

        return view('forms.index', ['forms' => $forms]);
    }

    public function store(Request $request){

        $form = new PrintForms();
        $form->name = $request->name;
        $form->slug = Str::slug($request->name);
        $form->type = $request->type;
        $form->save();

        $forms = PrintForms::where('type', $request->type)->get();

        return view('forms.part', ['forms' => $forms]);
    }

    public function spec_form($specialist){

        $specialist = Specialists::find($specialist);

        $forms = PrintForms::where('type', $specialist->alias)->get();

        return view('forms.spec_form', ['specialist' => $specialist, 'forms' => $forms]);
    }

    public function form_select(Request $request){

        $visit = Visits::find($request->visit);

        $info = VisitInfo::where('visit_id', $visit->id)->where('specialist', $request->specialist)->where('form', $request->form)->first();

        return view('visits.forms.'.$request->specialist.'.'.$request->form, ['visit' => $visit, 'specialist' => $request->specialist, 'form' => $request->form, 'info' => $info]);
    }

    public function form_print(Request $request, $visit){

        $visit = Visits::find($visit);

        $info = VisitInfo::where('visit_id', $visit->id)->where('specialist', $request->specialist)->where('form', $request->form)->first();

        return view('visits.forms.'.$request->specialist.'.print_'.$request->form, ['visit' => $visit, 'info' => $info]);
    }
}
