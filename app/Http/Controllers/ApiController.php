<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    //couldn't use isPalindrome in countPal cz undefined function
    public function isPalindrome($string){
        if ($string == strrev($string)){
            return true;
        }else{
            return false;
        }
    }
    
    public function countPal($array){
        // $array = array("hi", "aba", "yesey", "ahgs", "hiih");
        $count = 0;
        foreach($array as $value) {
            if($value == strrev($value)){
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
}
