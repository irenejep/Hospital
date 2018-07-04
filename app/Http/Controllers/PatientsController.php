<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Patient;

class PatientsController extends Controller
{
        public function patients(){
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
        public function update(Request $request){
            $this->validate($request,[
                'patient_fullname'=>'required',
                'patient_national_id'=>'required',
                'patient_dob'=>'required',
                'patient_gender'=>'required'
                ]);
            $patient_id = $request->input('patient_id');
            $patient = Patient::findOrFail($patient_id);
            $patient->patient_fullname = $request->input('patient_fullname');
            $patient->patient_national_id = $request->input('patient_national_id');
            $patient->patient_dob = $request->input('patient_dob');
            $patient->patient_gender = $request->input('patient_gender');
            $patient->save();
            }
        public function getSingle($patient_id){
            $patient = Patient::find($patient_id);
        echo json_encode ($patient);
        }
        public function delete(Patient $patient_id){
            $patient_id->delete();
            $patient = Patient::all();
            echo $patient;
        }
        public function webservice(){
           $config=array(
               'application_id'=>env('APPLICATION_ID'),
               'application_secret'=>env('APPLICATION_SECRET'),
               'application_phone'=>env('APPLICATION_PHONE'),
               'fromUser'=>env('APPLICATION_PHONE'),
                'fromUserName'=>('FROM_USERNAME'),
                'textMessage'=>('TEXT_MESSAGE'),
           );
            return view('group',$config);
        }
}
