<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\multiImg;
use App\Models\Category;
use \Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ProductController extends Controller
{
     //getAll products
     public function allProducts(){
        $products = Product::latest()->get();
        return view('backend.products.all_products',compact('products'));
    }//end method

    //add product get function
    public function addProduct(){
        $categories = Category::latest()->get();
        return view('backend.products.add_products',compact('categories'));
    }//end method
   
    //store product
    public function storeProduct(Request $req){
        $agency_id = Auth()->user()->id;
        $image = $req->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'_'.time().'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(448,280)->save('uploads/products/thambnail/'.$name_gen);
        $save_url = 'uploads/products/thambnail/'.$name_gen;
        $product_id = Product::insertGetId([
            'product_name'=>$req->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$req->product_name)),
            'product_code'=>$req->product_code,
            'product_qty'=>$req->product_qty,
            'category_id'=>$req->category_id,
            'selling_price'=>$req->selling_price,
            'discount_price'=>$req->discount_price,
            'short_descp'=>$req->short_descp,
            'long_descp'=>$req->long_descp,
            'product_thambnail'=>$save_url,
            'agency_id'=> $agency_id,
            'hot_deals' => $req->hot_deals,
            'featured' => $req->featured,
            'special_offer' => $req->special_offer,
            'special_deals' => $req->special_deals, 	
            'status' => 1,
        ]);

        if($req->file("multi_img")){
            $images = $req->file("multi_img");
            foreach($images as $img){
                $name_gen = hexdec(uniqid()).'_'.time().'.'.$image->getClientOriginalExtension();
                Image::make($img)->resize(800,800)->save('uploads/products/multi/'.$name_gen);
                $save_url = 'uploads/products/multi/'.$name_gen;
                multiImg::insert([
                    'product_id' => $product_id,
                    'photo_name' => $save_url,
                    'created_at' => Carbon::now()
                ]);
            }
            $notification = array(
                'message' => 'Tour added Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification); 
        }



    }//end method

    //edit product
    public function editProduct($id){
        $product = Product::findorfail($id);
        $categories = Category::orderBy('category_name','asc')->get();
        return view ('backend.products.edit_product',compact('product','categories'));

    }




}
