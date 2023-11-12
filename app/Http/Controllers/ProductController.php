<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    public function create(){
        $categories=Category::all();
        return view('admin.createproduct',compact('categories'));
    }
    public function add(Request $request){
        $data= $request->validate([
            "name"=>"required|string|max:255",
            "category_id"=>"required|exists:categories,id",
          
            "price"=>"required|numeric",
            "quantity"=>"required|integer",
            "desc"=>"required|string",
            "image"=>"required|image|mimes:png,jpg,jpeg"

        ]);
        $data['image']=Storage::putfile("Products",$data['image']); 
        
        Product::create($data);
        //view
        // $categories=Category::all();
        // return view('admin.createproduct',compact('categories'));

        //redirect
        return redirect(url("product/create"))->with("success","Product added successfuly");
      
    }
    public function showall(){
        $products=Product::all();
      
        return view('admin.allproducts',compact('products'));
    }
    public function showone($id){
        $product=Product::findorfail($id);
        return view('admin.showproduct',compact('product'));
    }
  public function edit($id){
    $product=Product::findorfail($id);
    return view('admin.editproduct',compact('product'));
  }
  public function update($id,Request $request){
    $data= $request->validate([
        "name"=>"required|string|max:255",
        "desc"=>"required|string",
        "price"=>"required|numeric",
        "quantity"=>"required|integer",
        "image"=>"nullable|image|mimes:png,jpg,jpeg"

    ]);
    $product=Product::findorfail($id);
    if ($request->has('image')) {
        Storage::delete($product->image);
        $data['image'] = Storage::putFile("products", $data['image']);
    }

    $product->update($data);
    return redirect(url('product/show/'.$id))->with("success","Product updated successfuly");
  }

  public function delete($id){
    $data= Product::findorfail($id);
     Storage::delete($data->image);
      $data->delete();
      return redirect(url("admin/allproducts"))->with("success","Product deleted successfuly");
  }
}
