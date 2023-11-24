<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\JoinedTour;
use App\Models\multiImg;
use Carbon\Carbon;
use App\Models\Category;


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


    public function leaveRoom(Request $req){
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
                $justcheck =JoinedTour::where('user_id', $user_id)->where('product_id', $product_id)->delete();
                if($justcheck){
                    Product::where('id', $product_id)->decrement('joined');
                    return response()->json([
                        "status" => 200,
                        "success" => "You have left ".$product_name." tour successfully"
                    ]);
                }
        }else{
            return response()->json([
                "status" => 200,
                "error" => "You have not joined ".$product_name." tour"
            ]);

        }
    }

    public function getTours(){
        $products = Product::orderBy('product_name')
        ->whereRaw('joined <= product_qty');
        return response()->json([
            "status" => 200,
            "products" => $products
        ]);
    }//end method

    // view single tour
    public function  getTour($id,$slug){
        $multiImage = multiImg::where('product_id',$id)->get(); 
        $product = Product::findorfail($id);
        $cat_id = $product->category_id;
        $otherProducts = Product::where('category_id', $cat_id)->where('id','!=', $id)->inRandomOrder()->limit(3)->get();
        return view('frontend.displays.view_tour',compact('product','multiImage','otherProducts'));
    }//end method


    //filtered tours , get according to category
    public function getSpecificTours($categoryid){
        $specific_products = Product::orderBy('product_name')->where('category_id',$categoryid)->get();
        return view('frontend.displays.view_specific_tours',compact('specific_products'));
    }//end method

    //display all joined tours
    public function allJoinedTours(){
        $joined_tours = JoinedTour::where('user_id',Auth()->user()->id)->pluck('product_id');
        $tours = Product::whereIn('id',$joined_tours)->get();
        return view ('frontend.displays.all_joined_tours',compact('tours'));
    }
    
    
}
