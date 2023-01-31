<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



 
class TestController extends Controller
{
 

    public function test(){
        die("whats up mother fucker");
    }

    public function Multiply($a,$b){
        return $c=$a*$b;
    }
}
