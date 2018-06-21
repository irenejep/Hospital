<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Patient;

class PatientController extends Controller
{
        public function index(){
            return view('patients');
        }
        public function save(Request $request){
            $this->validate($request,[
            'patient_fullname'=>'required',
            'patient_national_id'=>'required',
            'patient_dob'=>'required',
            'patient_gender'=>'required',
            ]);
            $patient = new Patient();
            $patient->patient_fullname = $request->patient_fullname;
            $patient->patient_national_id = $request->patient_national_id;
            $patient->patient_dob = $request->patient_dob;
            $patient->patient_gender = $request->patient_gender;
            $patient->save();
        }
        public function get(){
            echo Patient::all();
        }
        public function getSingle($patient_id){
            $patient = Patient::find($patient_id);
        echo json_encode ($patient);
        }
}
