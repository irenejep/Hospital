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

            $keyWord = $business_array[0]["businessName"];
            $location = $business_array[0]["businessLocation"];
            $lat = $business_array[0]["businessLat"];
            $long = $business_array[0]["businessLong"];
            
            $url ="http://infomoby-api.azurewebsites.net/index.php/ke/search_redesign/resultsredesign/".$keyWord."/".$location."/".$lat."/".$long."/0/3";
        //   $db_response = Category::join('businesses','categories.cat_id','=','businesses.cat_id')
        //               ->select('businesses.business_name','businesses.contact')
        //               ->where([
        //                   ['businesses.location','=',$location],
        //                   ['categories.cat_name','=',$category]
        //                   ])->get();
                        //   return $db_response;
            // $data = json_decode($db_response);

            // if(count($data)>0){
            //     // $message ="";
            //     $message =array();

            //     foreach($db_response as $response){
            //         $business = $response->business_name;
            //         $contact = $response->contact;
            //         $message[] = array("Business"=>$business,"Contact"=>$contact);
                     
            //     }

                // $url ="http://infomoby-api.azurewebsites.net/index.php/ke/search_redesign/resultsredesign/hotel/nairobi/-1.292066/36.821946/0/3";                
                // $data_string = json_encode($message); 
                                                                                                                                                                                                    
                 $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                     
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Authorization: 0c9e64ab66a28f5576e24c3b21614e88'                                                                             
                )                                                                       
                );                                                                                                                   
                                                                                                                     
                $result = curl_exec($ch);
                // dd($result);

        
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
    public function tesJson(){
        $result = '{"error":false,"success":200,"total_count":50,"companies":[{"advertisement":null,"company_id":138100,"company_name_en":"Emmaccra Hotel","category_id":39300,"category_name":"Hotels","description_en":null,"is_verified":1,"location":"-1.283631,36.826791","area_gps":"-1.279432,36.826318","display_address_en":"Accra Rd, Nairobi","building_name_en":"null","street_en":"Accra Rd","side_street_en":"0","pobox_en":"0","office_en":"0","floor_en":"0","building_number":"0","landmark_en":"0","avenue_en":"0","area_id":1439,"area_name_en":null,"area_synonyms_en":"null","city_id":289,"city_name_en":"Starehe","city_synonyms_en":"null","region_id":47,"region_name_en":"Nairobi","region_synonyms_en":"null","country_id":1,"country_name_en":"Kenya","hours":"1-7:0000-2359","logo":"null","bphone":"202242609","email":"null","website":"null","branch":"0","company_synonyms_en":"Emm-Accra, Accra, Emmaccra Hotel","company_keywords_en":"null","company_categories":"[{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_categories_ke\",\"_id\":\"138100\",\"_score\":39.945473,\"_routing\":\"138100\",\"_parent\":\"138100\",\"_source\":{\"company_id\":138100,\"category_id\":39300,\"category_name_en\":\"Hotels\"}}]","company_keywords":"","company_services":"[]","company_ratings":"[]","company_reviews":"[]","company_contacts":"[{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"2902591\",\"_score\":1,\"_routing\":\"138100\",\"_parent\":\"138100\",\"_source\":{\"company_id\":138100,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"202251026\",\"extension\":\"NULL\",\"contact_type\":\"PHONE\",\"display_order\":\"3\",\"status\":\"1\"}},{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"3203151\",\"_score\":1,\"_routing\":\"138100\",\"_parent\":\"138100\",\"_source\":{\"company_id\":138100,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"202250971\",\"extension\":\"NULL\",\"contact_type\":\"PHONE\",\"display_order\":\"4\",\"status\":\"1\"}},{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"1064281\",\"_score\":1,\"_routing\":\"138100\",\"_parent\":\"138100\",\"_source\":{\"company_id\":138100,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"202242609\",\"extension\":\"NULL\",\"contact_type\":\"PHONE\",\"display_order\":\"1\",\"status\":\"1\"}}]","company_contacts_person":"[{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"2902591\",\"_score\":1,\"_routing\":\"138100\",\"_parent\":\"138100\",\"_source\":{\"company_id\":138100,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"202251026\",\"extension\":\"NULL\",\"contact_type\":\"PHONE\",\"display_order\":\"3\",\"status\":\"1\"}},{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"3203151\",\"_score\":1,\"_routing\":\"138100\",\"_parent\":\"138100\",\"_source\":{\"company_id\":138100,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"202250971\",\"extension\":\"NULL\",\"contact_type\":\"PHONE\",\"display_order\":\"4\",\"status\":\"1\"}},{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"1064281\",\"_score\":1,\"_routing\":\"138100\",\"_parent\":\"138100\",\"_source\":{\"company_id\":138100,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"202242609\",\"extension\":\"NULL\",\"contact_type\":\"PHONE\",\"display_order\":\"1\",\"status\":\"1\"}}]"},{"advertisement":null,"company_id":256077,"company_name_en":"The Monarch Hotel","category_id":39300,"category_name":"Hotels","description_en":null,"is_verified":1,"location":"-1.296314,36.795262","area_gps":"0.907274,35.485909","display_address_en":"Rose Ave,Off Argwings Kodhek Rd, Kilimani,Nairobi","building_name_en":"null","street_en":"Rose ave off Argwings kodhek rd","side_street_en":"0","pobox_en":"0","office_en":"0","floor_en":"0","building_number":"0","landmark_en":"0","avenue_en":"0","area_id":1371,"area_name_en":null,"area_synonyms_en":"null","city_id":275,"city_name_en":"Dagoreti North","city_synonyms_en":"null","region_id":47,"region_name_en":"Nairobi","region_synonyms_en":"null","country_id":1,"country_name_en":"Kenya","hours":"1-7:0000-2359","logo":"20170301_192726_monarch.jpg","bphone":"203860777","email":"info@monarchhotelskenya.com","website":"http://monarchhotelskenya.com/","branch":"0","company_synonyms_en":"null","company_keywords_en":"null","company_categories":"[{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_categories_ke\",\"_id\":\"256077\",\"_score\":39.945473,\"_routing\":\"256077\",\"_parent\":\"256077\",\"_source\":{\"company_id\":256077,\"category_id\":39300,\"category_name_en\":\"Hotels\"}}]","company_keywords":"","company_services":"[]","company_ratings":"[]","company_reviews":"[]","company_contacts":"[{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"2278521\",\"_score\":1,\"_routing\":\"256077\",\"_parent\":\"256077\",\"_source\":{\"company_id\":256077,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"717708050\",\"extension\":\"NULL\",\"contact_type\":\"Mobile\",\"display_order\":\"2\",\"status\":\"1\"}},{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"923881\",\"_score\":1,\"_routing\":\"256077\",\"_parent\":\"256077\",\"_source\":{\"company_id\":256077,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"203860777\",\"extension\":\"NULL\",\"contact_type\":\"Phone\",\"display_order\":\"1\",\"status\":\"1\"}}]","company_contacts_person":"[{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"2278521\",\"_score\":1,\"_routing\":\"256077\",\"_parent\":\"256077\",\"_source\":{\"company_id\":256077,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"717708050\",\"extension\":\"NULL\",\"contact_type\":\"Mobile\",\"display_order\":\"2\",\"status\":\"1\"}},{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"923881\",\"_score\":1,\"_routing\":\"256077\",\"_parent\":\"256077\",\"_source\":{\"company_id\":256077,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"203860777\",\"extension\":\"NULL\",\"contact_type\":\"Phone\",\"display_order\":\"1\",\"status\":\"1\"}}]"},{"advertisement":null,"company_id":134313,"company_name_en":"Parkside Hotel","category_id":39300,"category_name":"Hotels","description_en":null,"is_verified":1,"location":"-1.280563,36.819005","area_gps":"-1.279432,36.826318","display_address_en":"Opp Jeevanjee Gardens, Monrovia St, Nairobi","building_name_en":"null","street_en":"Monrovia st","side_street_en":"0","pobox_en":"0","office_en":"0","floor_en":"0","building_number":"0","landmark_en":"0","avenue_en":"0","area_id":1439,"area_name_en":null,"area_synonyms_en":"null","city_id":289,"city_name_en":"Starehe","city_synonyms_en":"null","region_id":47,"region_name_en":"Nairobi","region_synonyms_en":"null","country_id":1,"country_name_en":"Kenya","hours":"1-7:0000-2359","logo":"20160830_195801_parkside-hotel.jpg","bphone":"710420859","email":"parksidehotelnairobikenya@gmail.com","website":"null","branch":"0","company_synonyms_en":"Parksyd, Parkside Hotel","company_keywords_en":"null","company_categories":"[]","company_keywords":"","company_services":"[]","company_ratings":"[]","company_reviews":"[]","company_contacts":"[{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"2134511\",\"_score\":1,\"_routing\":\"134313\",\"_parent\":\"134313\",\"_source\":{\"company_id\":134313,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"null\",\"extension\":\"NULL\",\"contact_type\":\"FAX\",\"display_order\":\"11\",\"status\":\"1\"}},{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"1030601\",\"_score\":1,\"_routing\":\"134313\",\"_parent\":\"134313\",\"_source\":{\"company_id\":134313,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"710420859\",\"extension\":\"NULL\",\"contact_type\":\"PHONE\",\"display_order\":\"1\",\"status\":\"1\"}}]","company_contacts_person":"[{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"2134511\",\"_score\":1,\"_routing\":\"134313\",\"_parent\":\"134313\",\"_source\":{\"company_id\":134313,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"null\",\"extension\":\"NULL\",\"contact_type\":\"FAX\",\"display_order\":\"11\",\"status\":\"1\"}},{\"_index\":\"index_companies_ke\",\"_type\":\"company_redesign_contacts_ke\",\"_id\":\"1030601\",\"_score\":1,\"_routing\":\"134313\",\"_parent\":\"134313\",\"_source\":{\"company_id\":134313,\"country_code\":\"NULL\",\"area_code\":\"NULL\",\"contact_number\":\"710420859\",\"extension\":\"NULL\",\"contact_type\":\"PHONE\",\"display_order\":\"1\",\"status\":\"1\"}}]"}]}';
        $myJson = json_decode($result);

       
            $theName = $myJson->companies[0]->company_name_en;
            $thePhone = $myJson->companies[0]->bphone;
            // dd($theName." ".$thePhone);

            // dd(count($myJson->companies));
            $myArray=[];
            for($i=0; $i<count($myJson->companies); $i++){
                $myArray[] =array("companyName"=>$myJson->companies[$i]->company_name_en,"companyPhone"=>"+254".$myJson->companies[$i]->bphone,"street"=>$myJson->companies[$i]->street_en);

            }
            dd(json_encode($myArray));
        
        
    }

}
