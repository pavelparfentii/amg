<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\PromoServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    public function index(){

        $promos = Promo::all();

        return view('promo.index', ['promos' => $promos]);
    }

    public function store(Request $request){

        $promo = new Promo();
        $promo->name = $request->name;
        $promo->alias = Str::slug($request->name);
        $promo->slug = $request->slug;
        $promo->discount_percent = $request->discount_percent;
        $promo->discount_absolute = $request->discount_absolute;
        $promo->active = $request->active;
        $promo->save();

        $promos = Promo::all();

        return view('promo.part', ['promos' => $promos]);
    }

    public function services($id){

        $promo = Promo::find($id);

        $promos = PromoServices::where('promo_id', $id)->get();

        return view('promo.services', ['promo' => $promo, 'promos' => $promos]);
    }

    public function service_add(Request $request, $id){

        $promos = PromoServices::where('promo_id', $id)->where('service_id', $request->service)->first();
        if(!$promos){
            $promos = new PromoServices();
            $promos->promo_id = $id;
            $promos->service_id = $request->service;
            if($request->discount_percent){
                $promos->discount_percent = $request->discount_percent;
            }
            if($request->discount_absolute){
                $promos->discount_absolute = $request->discount_absolute;
            }
            $promos->save();
        }

        $promo = PromoServices::where('promo_id', $id)->get();

        return view('promo.service_part', ['promo' => $promo]);
    }
}
