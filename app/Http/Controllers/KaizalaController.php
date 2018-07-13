<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaizalaController extends Controller
{
    function infomoby(Request $request){
        $keyword = $request->keyword;
        $location = $request->location;
        $lat = $request->lat;
        $long = $request->long;
        // $keyword = "Hotel";
        // $location = "nairobi";
        // $lat = "-1.28333";
        // $long = "36.81667";
        
        // $lattitude = $request->lat;
        // $longitude = $request->long;
        // $location = $request->location;
        // $keyWord = $request->keyWord;
        // $baseUrl = "http://infomoby-api.azurewebsites.net/index.php/ke/search_redesign/resultsredesign/".$keyword."/".$location."/".$lat."/".$long."/o/3";
        $urlss = "http://infomoby-api.azurewebsites.net/index.php/ke/search_redesign/resultsredesign/".$keyword."/".$location."/".$lat."/".$long."/0/16";
        $conn = curl_init($urlss);
        $header = array("Authorization: 0c9e64ab66a28f5576e24c3b21614e88");

         curl_setopt($conn, CURLOPT_CUSTOMREQUEST, "GET");
         curl_setopt($conn, CURLOPT_HTTPHEADER, $header);
         curl_setopt($conn, CURLOPT_RETURNTRANSFER, true);
         
         $result = curl_exec($conn);
         dd($result);
         curl_close($conn);

        $myObject = json_decode($result);
        $returnJson = "[";
        $len = count($myObject->companies);

        for($i=0; $i<$len; $i++){
            $returnJson .= "{\"cartegory\":\"".$myObject->companies[$i]->category_name."\",";
            $returnJson .= "\"companyName\":\"".$myObject->companies[$i]->company_name_en."\",";
            $returnJson .= "\"companyContact\":\"".$myObject->companies[$i]->bphone."\",";
            if($i == $len-1){
            $returnJson .= "\"companyStreet\":\"".$myObject->companies[$i]->street_en."\"}";
             }
             else{
            $returnJson .= "\"companyStreet\":\"".$myObject->companies[$i]->street_en."\"},";
             }
            // echo $myObject->companies[$i]->company_name_en."<br>";
    }
    $returnJson .= "]";

    echo $returnJson;
        // echo $result;

    }
}
