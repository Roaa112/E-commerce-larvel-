<?php

namespace App\Http\Controllers; 

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){
        if(Auth::user()->role==="user"){
          
            $products = Product::limit(3)->get();
            return view("user.home")->with('products', $products);
        }else{
            return view("admin.home");
        }

    }
}
