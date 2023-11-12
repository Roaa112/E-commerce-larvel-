<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;

class CategoryController extends Controller
{
    public function create(){
        return view('admin.createcategory');
    }
 
    public function add(Request $request) {
        $data = $request->validate([
            "name" => "required|string|max:100"
        ]);
    
        Category::create($data);
        
        return redirect(url("category/create"))->with("success","Category added successfuly");
      
    }
}
