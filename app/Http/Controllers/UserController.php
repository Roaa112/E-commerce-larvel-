<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
   
    public function viewAllProducts(){
     
        $products=Product::all();
        return view('user.viewAllProducts',compact('products'));
    }
    public function show($id){
        $product=Product::findOrFail($id);
        return view('user.productShow', compact('product'));

    }
   public function home(){
    if(Auth::user()){
         if(Auth::user()->role==="user"){
            $products = Product::limit(3)->get();
            return view("user.home")->with('products', $products);
        }else if(Auth::user()->role==="admin"){
            return view("admin.home");
        }
    }else{
        $products = Product::limit(3)->get();
        return view("user.home")->with('products', $products);

    }
       
   
   

   }
   public function search(Request $request){
    $key=$request->key;
    $products = Product::where("name","like","%$key%")->get();
    return view("user.home")->with('products', $products);
   }
   public function addtocart($id,Request $request){
    $product =  Product::findOrFail($id);
    $qty = $request->qty;
    if(! $product)
    {
       abort(404);
    }
    $cart = session()->get("cart");
    
    if(! $cart)
    {
      $cart = [
       $id => [
           "name"=>$product->name,
           "qty"=>$qty,
           "price"=>$product->price,
           "image"=>$product->image,
       ]
      ];
      session()->put("cart",$cart);
    //   var_dump(session()->get("cart"));
      return redirect()->back()->with("success","product addedd to cart successfuly");
    }else {
       if(isset($cart[$id])) {
           $oldqty = $cart[$id]["qty"];
           $newQty = $oldqty + $qty;
                   $cart[$id]['qty'] = $newQty ;
                   session()->put('cart', $cart);
                //    var_dump(session()->get("cart"));
                   return redirect()->back()->with('success', 'Product added to cart successfully!');
        }else{
            $cart[$id] = [
                "name"=>$product->name,
                "qty"=>$qty,
                "price"=>$product->price,
                "image"=>$product->image,
               ];
               session()->put('cart', $cart);
               return redirect()->back()->with('success', 'Product added to cart successfully!');
            // var_dump(session()->get("cart"));

   }}

 }

 public function MyCart(){
    // Session::flush();
 $products=session()->get("cart");
 if( $products){
    $number=count($products);
    return view('user.viewMyCart',compact('products','number'));
 }
 return view('user.viewMyCart');
 
        
           
       
 }

 public function makeOrder(Request $request)
 {
  $products  = session()->get("cart");
  $user = Auth::user();
  $requiredDate = $request->day;
  $order =   Order::create([
      "requiredDate"=>$requiredDate,
      "user_id"=>$user->id,
  ]);
  // dd($products[1]);
  foreach($products as $id=>$data){
      // dd($id , $data);
      OrderDetail::create([
          "order_id"=>$order->id,
          "product_id"=>$id,
          "quantity"=>$data['qty'],
          "price"=>$data['price']
      ]);
  }
  
  return redirect(url(""))->with('success', 'you make your order successfully!');
 }


 

}