<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function all(){
        $products=Product::all();
        if($products!==null){
            return ProductResource::collection($products);
        }else{
            return response()->json([
                "msg"=>"there is no products"
            ],404);
        }
        
    }
    public function one($id){
        $product=Product::find($id);
        if($product!==null){
            return  new ProductResource($product);
        }else{
            return response()->json([
                "msg"=>"there is no product with tis id"
            ],404);
        }
        
    }
 
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        "name" => "required|string|max:255",
        "desc" => "required|string",
        "price" => "required|numeric",
        "quantity" => "required|integer",
        "category_id" => "required|integer",
        "image" => "required|image|mimes:png,jpg,jpeg"
    ]);

    if ($validator->fails()) {
        return response()->json([
            "msg" => "Failed to insert"
        ], 301);
    }

    $image = Storage::putFile("products", $request->file('image'));

    Product::create([
        "name" => $request->name,
        "quantity" => $request->quantity,
        "desc" => $request->desc,
        "price" => $request->price,
        "image" => $image,
        "category_id" => $request->category_id
    ]);

    return response()->json([
        "msg" => "Product added successfully"
    ], 201);
}

public function edit($id, Request $request)
{
    $validator = Validator::make($request->all(), [
        "name" => "required|string|max:255",
        "desc" => "required|string",
        "price" => "required|numeric",
        "quantity" => "required|integer",
        "category_id" => "required|integer",
        "image" => "nullable|image|mimes:png,jpg,jpeg"
    ]);

    if ($validator->fails()) {
        return response()->json([
            "msg" => "Failed to update"
        ], 301);
    }

    $product = Product::find($id);
    if ($product === null) {
        return response()->json([
            "msg" => "There is no product with this id"
        ], 404);
    }

    $image = $product->image;
    if ($request->has("image")) {
        Storage::delete($product->image);
         $image = Storage::putFile("products", $request->image);
          
    }

    $product->update([
        "name" => $request->name,
        "quantity" => $request->quantity,
        "desc" => $request->desc,
        "price" => $request->price,
        "image" => $image,
        "category_id" => $request->category_id
    ]);

    return response()->json([
        "msg" => "Product updated successfully"
    ], 201);
}

public function delete($id)
{
    $product = Product::find($id);
    if ($product === null) {
        return response()->json([
            "msg" => "There is no product with this id"
        ], 404);
    }

    Storage::delete($product->image);
    $product->delete();

    return response()->json([
        "msg" => "Deleted successfully"
    ], 200);
}
}
