<?php

use App\Http\Middleware\IsUser;

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); 
});

Route::get('/redirect',[HomeController::class,"redirect"]);

Route::middleware(IsAdmin::class)->group(function(){
//create Category 
Route::get("",[UserController::class,"home"]);
Route::get('/category/create',[CategoryController::class,"create"]);
Route::post('/addcategory',[CategoryController::class,"add"]);
//create product
Route::get('/product/create',[ProductController::class,"create"]);
Route::post('/addproduct',[ProductController::class,"add"]);
//show all products
Route::get('/admin/allproducts',[ProductController::class,"showall"]);
//show one
Route::get('admin/product/show/{id}',[ProductController::class,"showone"]);
//edit
Route::get('/product/edit/{id}',[ProductController::class,"edit"]);
Route::put('/update/{id}',[ProductController::class,"update"]);

//delete
Route::get('product/delete/{id}',[ProductController::class,"delete"]);






}); 

Route::get("Change/{lang}",function($lang){
if($lang ==="ar"){
    session()->put("lang","ar");
}else{
    session()->put("lang","en");
}
 
return redirect()->back();
});



//user routes
Route::controller(UserController::class)->group(function(){
 //gest ,user
    Route::get("","home");
    Route::get("allproducts","viewAllProducts");
    Route::get("product/show/{id}","show");
    Route::get("search","search");
    //middelware
    Route::middleware(IsUser::class)->group(function(){
   Route::post("addtocart/{id}","addtocart");
   Route::get("MyCart","MyCart");
   Route::post("makeOrder","makeOrder");
});

});
