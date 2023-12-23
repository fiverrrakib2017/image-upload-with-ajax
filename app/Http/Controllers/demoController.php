<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class demoController extends Controller
{
    public function index(){
        $ch_session = curl_init();
        $url="https://jsonplaceholder.typicode.com/todos";
        curl_setopt($ch_session, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch_session, CURLOPT_URL, $url);

        $result_url = curl_exec($ch_session);
        $jsonData=json_decode($result_url);

       

        return view('Welcome',compact('jsonData'));
        dd($result_url);
        
    }
}
