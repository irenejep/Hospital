<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Visit;

class VisitController extends Controller
{
    public function visits(){
        return view('visits');
    }
    public function save(Request $request){
        $this->validate($request,[
        'visit_date'=>'required',
        'visit_type'=>'required',
        'visit_exit_time'=>'required',
        'visit_status'=>'required'
        ]);
        $visit = new Visit();
        $visit->patient_id = $request->patient_id;
        $visit->patient_name = $request->patient_name;
        $visit->visit_date = $request->visit_date;
        $visit->visit_type = $request->visit_type;
        $visit->visit_exit_time = $request->visit_exit_time;
        $visit->visit_status = $request->visit_status;
        $visit->save();
        $visit = \DB::table('visit')
        ->join('patient', 'patient.patient_id', '=', 'visit.patient_id')
        ->select('patient.patient_name')
        ->where ('patient.patient_id','=','patient_id')
        ->get();
        echo $request;
    }
    public function get(){
        echo Visit::all();
    }
    public function update(Request $request){
        $this->validate($request,[
            'visit_date'=>'required',
            'visit_type'=>'required',
            'visit_exit_time'=>'required',
            'visit_status'=>'required'
            ]);
        $visit_id = $request->input('visit_id');
        $visit = Visit::findOrFail($visit_id);
        $visit->visit_date = $request->input('visit_date');
        $visit->visit_type = $request->input('visit_type');
        $visit->visit_exit_time = $request->input('visit_exit_time');
        $visit->visit_status = $request->input('visit_status');
        $visit->save();
        }
        public function getSingle($visit_id){
            $visit = Visit::find($visit_id);
        echo json_encode ($visit);
        }
        public function delete(Visit $visit_id){
            $visit_id->delete();
            $visit = Visit::all();
            echo $visit;
        }
        public function map(Request $request, $location)
        {
            $name = $request->input('location');
            return $name; 
        }
}
