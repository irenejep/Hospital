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
            'patientFullName'=>'required',
            'patientNationalId'=>'required',
            'patientDob'=>'required',
            'patientGender'=>'required',
            ]);
            $patient = new Patient();
            $patient->patientFullName = $request->input('patientFullName');
            $patient->patientNationalId = $request->input('patientNationalId');
            $patient->patientDob = $request->input('patientDob');
            $patient->patientGender = $request->input('patientGender');
            $patient->save();
        }
        public function get(){
            echo Patient::all();
           
        }
}
