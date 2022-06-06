<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


function isPalindrome($string){
    if ($string == strrev($string)){
        return true;
    }else{
        return false;
    }
}

class ApiController extends Controller
{
    public function countPal($array){
        // $array = array("hi", "aba", "yesey", "ahgs", "hiih", "hih");
        $count = 0;
        foreach($array as $value) {
            // if($value == strrev($value)){
            //     $count = $count + 1;
            // }
            if (isPalindrome($value) == true){
                $count = $count + 1;
            }
        }
        echo $count;
    }

    public function getTime(){
        $current_date = date(time()); //since 1/1/1970
        $years = 237*365*24*60*60; //years from 1732 tp 1970
        $months = 8*30*24*60*60; //months from april till january
        $days = 16*24*60*60; //days from 14 till 1
        
        $time_to_add = $years + $months + $days;
        $seconds_passed = $current_date + $time_to_add;
        
        return response()->json([
            "status" => "Success",
            "result" => $seconds_passed
        ], 200);
    }

    public function nominee($array){
        // $array = array("jp", "ali", "alaa", "pablo", "pablo", "pablo");
        echo $array[array_rand($array)];
    }

    public function toList($student_array){
        // $student_array = array("jp", "joe", "michel", "lama", "nour", "anthony", "ali");
        $solution = array();
        $sub = array();
        if(count($student_array) % 2 == 0){
            foreach($student_array as $value) {
                if(count($sub) < 2){
                    array_push($sub, $value);
                    if(count($sub) == 2){
                        array_push($solution, $sub);
                        $sub = array();
                    }
                }
            }
            return $solution;         
        }else{
            $sliced = array_slice($student_array, 0, count($student_array)-1);
            foreach($sliced as $value) {
                if(count($sub) < 2){
                    array_push($sub, $value);
                    if(count($sub) == 2){
                        array_push($solution, $sub);
                        $sub = array();
                    }
                }
            }
            $last = $student_array[count($student_array)-1];
            array_push($solution, $last);
            return $solution;
        }
    }

    public function getApi($url){
        $given_url = $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $given_url);
 
        $result = curl_exec($ch);
        $var = json_decode($result, true);
 
        return $var["attachments"][0]["text"];
        
    }

    public function getRecipe(){
        $given_url = 'https://api.punkapi.com/v2/beers';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $given_url);
 
        $result = curl_exec($ch);
        $var = json_decode($result, true);
        $rand = array_rand($var);
        return $var[$rand]["ingredients"];
    }
}
