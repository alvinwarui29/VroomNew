<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function ProductSearch(Request $req){

        $req->validate(['search'=>'required']);
        $item = $req->search;
        $tours = Product::where('product_name','LIKE',"%$item%")->get();
        return view('frontend.displays.search',compact('tours','item'));
    }
}
