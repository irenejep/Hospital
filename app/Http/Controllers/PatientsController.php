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
            //    'fromUser'=>env('APPLICATION_PHONE'),
            //     'fromUserName'=>env('FROM_USERNAME'),
            //     'textMessage'=>env('TEXT_MESSAGE'),
           );
            return view('group',$config);
        }
        public function authenticate(){
            $data = json_decode( file_get_contents( 'php://input' ), true );
            if(is_array($data)&& (count($data) > 0 ))
            {
                $mobile =$data[0]["fromUser"];
                $name =$data[0]["fromUserName"];
                $message =$data[0]["textMessage"];
            }
            if(stripos($message, "bomb") != false)
            {
                $$messageData = $name.", such words are unacceptable in this group.";
                $url = "https://prod-00.westeurope.logic.azure.com:443/workflows/203a80be71114268a7cf28f34a16866f/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=P3-kXWa7kvR-7StQ0OcWSfnHmsB96ImXYlsCO-gxAL8/authenticate";                                                                  
                $data_string = json_encode($messageData); 
            }                                                                                                                                                                                        
            $ch = curl_init('https://prod-00.westeurope.logic.azure.com:443/workflows/203a80be71114268a7cf28f34a16866f/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=P3-kXWa7kvR-7StQ0OcWSfnHmsB96ImXYlsCO-gxAL8/authenticate');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
            );                                                                                                                   
                                                                                                                     
        $result = curl_exec($ch);
                }
        }
