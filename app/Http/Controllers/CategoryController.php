<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategories()
    {
        return view('backend.category.all');
    }//end method

    public function addCategory()
    {
        return view('backend.category.add');
    }//end method

    public function storeCategory(Request $request)
    {
      
    }//end method
}
