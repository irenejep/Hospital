<?php

namespace App\Http\Controllers;
use App\Business;
use App\Category;

use Illuminate\Http\Request;

class BusinessController extends Controller
{
    //
    public function business(){
        $business_Json = file_get_contents('php://input');
        $business_array = json_decode($business_Json);

        if((is_array($business_array)) && (count($business_array)>0)){

            $category = $business_array[0]["businessName"];
            $location = $business_array[0]["businessLocation"];
            
          $db_response = Category::join('businesses','categories.cat_id','=','businesses.cat_id')
                      ->select('businesses.business_name','businesses.contact')
                      ->where([
                          ['businesses.location','=',$location],
                          ['categories.cat_name','=',$category]
                          ])->get();
                        //   return $db_response;
            $data = json_decode($db_response);

            if(count($data)>0){
                // $message ="";
                $message =array();

                foreach($db_response as $response){
                    $business = $response->business_name;
                    $contact = $response->contact;
                    $message[] = array("Business"=>$business,"Contact"=>$contact);
                     
                }

                $url ="";                
                $data_string = json_encode($message); 
                                                                                                                                                                                                    
                 $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen($data_string))                                                                       
                );                                                                                                                   
                                                                                                                     
                $result = curl_exec($ch);
            }

            else{
                $url =""; 
                $str = array("message"=>"Sorry we can't find the search item");               
                $data_string = json_encode($str); 
                                                                                                                                                                                                    
                 $ch = curl_init($url);
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
    }

}
