<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;

class ServiceController extends Controller
{
    public function services(){
       return view ('services');
    }
    public function save(Request $request){
        $this->validate($request,[
        'service_name'=>'required',
        'service_amount'=>'required'
        ]);
        $service = new Service();
        $service->service_name = $request->service_name;
        $service->service_amount = $request->service_amount;
        $service->save();
    }
    public function get(){
        echo Service::all();
    }
    public function update(Request $request){
        $this->validate($request,[
        'service_name'=>'required',
        'service_amount'=>'required'
        ]);
        $service_id = $request->input('service_id');
        $service = Service::findOrFail($service_id);
        $service->service_name = $request->input('service_name');
        $service->service_amount = $request->input('service_amount');
        $service->save();
        }
    public function getSingle($service_id){
        $service = Service::find($service_id);
    echo json_encode ($service);
    }
    public function delete(Service $service_id){
        $service_id->delete();
        $service = Service::all();
        echo $service;
    }
}