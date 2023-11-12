<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register(Request $request){
        $val=Validator::make($request->all(),[
            "name"=>"required|string|max:100",
            "email"=>"required|email|max:255|unique",
            "password"=>"required|string|min:8|confirmed"
        ]);
        if($val->fails()){
            return response()->json([
                "errors"=>$val->errors()
            ],301);
        }
        //hash password
        $password=bcrypt($request->password);
        //acsses token 
        $accses_token= Str::random(64);
        //create
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$password,
            "accses_token"=>$accses_token
        ]);

             return response()->json([
                "success"=>"regetered successfuly",
                "accses_token"=>$accses_token
            ],201);
       

    }
    public function login (Request $request){
        $val=Validator::make($request->all(),[
            "name"=>"required|string|max:100",
            "email"=>"required|email|max:255"
        ]);
        if($val->fails()){
            return response()->json([
                "errors"=>$val->errors()
            ],301);
        }
        $user=User::where("email",$request->email)->first();
        if($user===null){
            return response()->json([
                "errors"=>"email is not correct"
            ],301);
        }
        $oldpassword=$user->password;
        $accses_token=Str::random(64);
       $isverified= Hash::check($request->password,$oldpassword);
       if($isverified){
        User::update([
            "accses_token"=>$accses_token
        ]);

        return response()->json([
            "success"=>"you loged in succcessfuly",
            "accses_token"=>$accses_token
        ],301);
       }else{
        return response()->json([
            "errors"=>"password is not correct"
        ],301);
       }

    }
}
