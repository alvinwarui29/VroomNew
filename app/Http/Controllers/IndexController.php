<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class IndexController extends Controller
{
    public function ProductSearch(Request $req){

        $req->validate(['search'=>'required']);
        $item = $req->search;
        $tours = Product::where('product_name','LIKE',"%$item%")->get();
        return view('frontend.displays.search',compact('tours','item'));
    }// end function
    public function viewTourByAgency($agency_id){
        $tours = Product::where('agency_id',$agency_id)->get();
        $agencies = User::where('role','agency')->get();
        return view('frontend.displays.view_tour_by_agency',compact('tours','agencies'));

    }//end method
}
