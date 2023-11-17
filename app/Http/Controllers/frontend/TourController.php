<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\JoinedTour;
use App\Models\multiImg;
use Carbon\Carbon;


class TourController extends Controller
{
    public function joinRoom(Request $req){
        $user_id = $req->user_id;
        $product_id = $req->product_id;
    
        // Check if the product exists
        $product = Product::find($product_id);
        if (!$product) {
            return response()->json([
                "status" => 404,
                "error" => "Product not found"
            ]);
        }
    
        $product_name = Product::where('id', $product_id)->value('product_name');
        $isUserJoined = JoinedTour::where('user_id', $user_id)->where('product_id', $product_id)->exists();
    
        if ($isUserJoined) {
            // Increment the joined column in the products table
            return response()->json([
                "status" => 200,
                "error" => "You have already joined ".$product_name." tour"
            ]);
        }
    
        $added_id = JoinedTour::insertGetId([
            "user_id" => $user_id,
            "product_id" => $product_id,
            "created_at" => Carbon::now()
        ]);
    
        if ($added_id) {
             // Increment the joined column in the products table
             Product::where('id', $product_id)->increment('joined');
            return response()->json([
                "status" => 200,
                "success" => "You have joined ".$product_name." tour successfully"
            ]);
        } else {
            return response()->json([
                "status" => 401,
                "error" => "Unable to add ".$product_name." tour"
            ]);
        }
    }//end method

    public function getTours(){
        $products = Product::orderBy('product_name')
        ->whereRaw('joined <= product_qty');
        return response()->json([
            "status" => 200,
            "products" => $products
        ]);
    }//end method

    public function  getTour($id,$slug){
        $multiImage = multiImg::where('product_id',$id)->get(); 
        $product = Product::findorfail($id);
        return view('frontend.displays.view_tour',compact('product','multiImage'));
    }
    
    
}
