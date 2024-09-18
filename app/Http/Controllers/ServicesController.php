<?php

namespace App\Http\Controllers;

use App\Models\Calculyation;
use App\Models\SelfService;
use App\Models\Service;
use App\Models\ServicesGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;


class ServicesController extends Controller
{
    public function index(){

        $services = Service::where('active', true)->get();

        $groups = ServicesGroup::where('active', true)->get();

        return view('services.index', ['services' => $services, 'groups' => $groups]);
    }

    public function store(Request $request){
        $service = new Service();
        $service->name = $request->name;
        $service->group_id = $request->parent;
        $service->price = $request->price;
        $service->cost = $request->cost;
        $service->doctor_price = $request->doctor_price;
        $service->save();

        $services = Service::where('group_id', $request->parent)->get();

        return view('services.part', ['services' => $services]);
    }

    public function select2service(Request $request){

        if($request->has('q')){
            $search = $request->q;
            $data = Service::select("id","name")
                ->where('name', 'LIKE', "%$search%")
                ->orwhere('id', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function select2analizy(Request $request){

        if($request->has('q')){
            $search = $request->q;
            $data = Service::select("id","name", "article")
                ->whereIn('group_id', function($query){
                   $query->select('id')->from('services_groups')->where('parent_id', '2');
                })
                ->where('name', 'LIKE', "%$search%")
                ->orwhere('id', 'LIKE', "%$search%")
                ->orwhere('article', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function groups(){

        $groups = ServicesGroup::whereNull('parent_id')->get();

        return view('services.groups', ['groups' => $groups]);
    }

    public function groupsBy($id){

        $groups = ServicesGroup::where('parent_id', $id)->get();

        $groupBy = ServicesGroup::find($id);

        $services = Service::where('group_id', $id)->get();

        if($groups->first()){
            return view('services.groups', ['groups' => $groups, 'groupBy' => $groupBy]);
        }
        return view('services.index', ['groupBy' => $groupBy, 'services' => $services]);
    }

    public function groups_store(Request $request){

        if($request->name){
            $group = new ServicesGroup();
            $group->name = $request->name;
            $group->alias = Str::slug($request->name);
            $group->active = $request->active;
            $group->parent_id = $request->parent;
            $group->save();
        }

        $groups = ServicesGroup::whereNull('parent_id')->get();

        return view('services.groups_part', ['groups' => $groups]);
    }

    public function select2groups(Request $request){
        if($request->has('q')){
            $search = $request->q;
            $data = ServicesGroup::select("id","name")
                ->where('name', 'LIKE', "%$search%")
                ->orwhere('id', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function get_service_price($service){

        $service = Service::find($service);

        return $service->price;
    }

    public function group_edit($group){

        $group = ServicesGroup::find($group);

        return view('services.group_edit', ['group' => $group]);
    }

    public function group_update(Request $request, $group){

        $group = ServicesGroup::find($group);

        $group->name = $request->name;
        $group->alias = Str::slug($request->name);
        $group->active = $request->active;
        $group->parent_id = $request->parent;
        $group->save();

        $groups = ServicesGroup::whereNull('parent_id')->get();

        return view('services.groups_part', ['groups' => $groups]);

    }

    public function edit($service){

        $service = Service::find($service);

        $groups = ServicesGroup::where('active', true)->get();

        return view('services.edit', ['service' => $service, 'groups' => $groups]);
    }

    public function update(Request $request, $service){

        $service = Service::find($service);
        $service->name = $request->name;
        $service->group_id = $request->parent;
        $service->price = $request->price;
        $service->cost = $request->cost;
        $service->doctor_price = $request->doctor_price;
        $service->save();

        $services = Service::where('group_id', $request->parent)->get();

        return view('services.part', ['services' => $services]);
    }

    public function importXlsService(Request $request){
        $service_groups = ServicesGroup::where('active', true)->get();
        foreach ($service_groups as $serviceGroup) {
            $serviceGroupData[$serviceGroup->id] = $serviceGroup->name;
        }

        if($request->import_file) {
            if ($request->hasFile('import_file')) {
                $path = $request->file('import_file')->getRealPath();
                $data = \Excel::toArray('', $path, null, Excel::XLSX)[0];
                if (!empty($data)) {
                    foreach($data as $key => $d) {
                        if($d[1]){
                            $service = Service::where('article', $d[0])->first();
                            if($service){
                                $service->name = $d[1];
                                if(isset($d[6])) {
                                    $service->price = $d[6];
                                }
                                if(isset($d[5])){
                                    $service->cost = $d[5];
                                }
                                if (isset($d[2])){
                                    $service->description = $d[2];
                                }
                                if(isset($d[7])){
                                    $service->doctor_price = $d[7];
                                }
                                else{
                                    if(isset($d[6])){
                                        $service->doctor_price = $d[6]*0.1;
                                    }
                                }
                                $service->save();
                            }
                            else{
                                $service = new Service();
                                $service->name = $d[1];
                                if(isset($d[6])){
                                    $service->price = $d[6];
                                }
                                if(isset($d[5])){
                                    $service->cost = $d[5];
                                }
                                if (isset($d[2])){
                                    $service->description = $d[2];
                                }
                                if(isset($d[7])){
                                    $service->doctor_price = $d[7];
                                }
                                $service->group_id = $request->group;
                                $service->article = $d[0];
                                $service->save();
                            }
                        }
                    }
                }
            }
        }
        return view('services.import', [
            'service_groups' => $serviceGroupData,
        ]);
    }

    public function service_info($id){

        $service = Service::find($id);
        $service->group = $service->parent->name;

        return $service;
    }

    public function serviceSearch(Request $request){
        if($request->has('q')){
            $search = $request->q;
            $data = SelfService::select("id","name")
                ->where('name', 'LIKE', "%$search%")
                ->orwhere('id', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function lastPrice($id, $calc){

        $calculyation = Calculyation::find($calc);

        $service = SelfService::find($id);

        if($service->cost_uah){
            $price = $service->cost_uah;
        }
        if($service->cost_percent){
            $price = round($calculyation->service->price * ($service->cost_percent / 100), 2);
        }

        return $price;
    }

}
