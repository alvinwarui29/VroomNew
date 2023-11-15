<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexPage(){
        return view('frontend.index');
    }
    
}
