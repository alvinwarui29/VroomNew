<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use \Intervention\Image\Facades\Image; 
class CategoryController extends Controller
{
    public function allCategories()
    {
        $categories = Category::all();
        return view('backend.categories.all_categories',compact('categories'));
    }//end method

    public function addCategory()
    {
        return view('backend.categories.add_categories');
    }//end method

    public function storeCategory(Request $req)
    {
        $name = $req->category_name;
        $image = $req->file('category_image');
        $name_gen = hexdec(uniqid())."." . $image->getClientOriginalExtension();
        Image::make($image)->resize('120','120')->save('uploads/categories_images/'.$name_gen);

        Category::insert([
            "category_name" => $name,
            "category_image"=>$name_gen,
        ]);
        $notification = array(
            "message"=>"Category added successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
      
    }//end method
}
