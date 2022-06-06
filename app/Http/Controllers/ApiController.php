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
    //counting the palindromes of an array
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

    //getting the time passed sin 14 april 1732
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

    //selecting a random name
    public function nominee($array){
        // $array = array("jp", "ali", "alaa", "pablo", "pablo", "pablo");
        echo $array[array_rand($array)];
    }


    //dividing to an array of arrays
    public function toList($student_array){
        // $student_array = array("jp", "joe", "michel", "lama", "nour", "anthony", "ali");
        $solution = array();
        $sub = array();
        //checking if the length of the array is even
        if(count($student_array) % 2 == 0){
            foreach($student_array as $value) {
                if(count($sub) < 2){
                    array_push($sub, $value); //storing in temp array
                    if(count($sub) == 2){
                        array_push($solution, $sub); //pushing the tem array ength 2 to the solution
                        $sub = array(); //resetting the temp array
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

    //getting the text
    public function getApi($url){
        $given_url = $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $given_url);
 
        $result = curl_exec($ch);
        $var = json_decode($result, true); //converting to array
 
        return $var["attachments"][0]["text"];
        
    }
    
    //getting the beer recipe
    public function getRecipe($url){
        $given_url = $url; //assigning the url
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $given_url);
 
        $result = curl_exec($ch);
        $var = json_decode($result, true); //converting to array
        $rand = array_rand($var); //selecting a random element from the array
        return $var[$rand]["ingredients"];
    }
}
