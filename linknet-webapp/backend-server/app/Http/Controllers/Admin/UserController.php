<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller {
    
    function addorUpdateUser(Request $request, $id = null){
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'user_type_id' => 'integer',
            'locations' => 'array',
            'pic_url' => 'string',
            'bio' => 'string'
        ]);

        if($validator->fails()){//if validation fails then return error
            return response()->json([
                "status" => "validation failed",
                "results" => []
            ], 400);
        }elseif (!$id){//if the id is null then we are adding a user else we are updating one
            $user = new User;
        }else { 
            $user = User::find($id);
            if (!$user){
                return response()->json([
                    'response' => 'user not found'
                ]);
            }
        }

        $user->user_type_id = $request->user_type_id ? $request->user_type_id: $user->user_type_id;
        $user->username = $request->username ? $request->username : $user->username;
        $user->email = $request->email ? $request->email : $user->email;
        $user->password = bcrypt($request->password) ? bcrypt($request->password) : $user->password;
        $user->locations = $request->locations ? $request->locations : $user->email;
        $user->pic_url = $request->pic_url ? $request->pic_url : $user->pic_url;
        $user->bio - $request->bio ? $request->bio : $user->bio;

        if($user->save()){
            return response()->json([
                "status" => "success",
                "results" => ""//here i will return the jwt token
            ], 200);
        }else {
            return response()->json([
                "status" => "failed",
                "results" => []
            ], 400);
        }
    }

    function deleteUser($id) {
        if($id){
            $user = User::find($id);
            if ($user->delete()){
                return response()->json([
                    "status" => "successfuly deleted user",
                    "results" => []
                ], 200);
            }else {
                return response()->json([
                    "status" => "failed to delete user because user doesnt exist",
                    "results" => []
                ], 400);
            }
        }
    }

    function signUp(Request $request){//here is the signup for regular users
        //must validate user input
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        if($validator->fails()){ //if validation fails then return error
            return response()->json([
                "status" => "validation failed",
                "results" => []
            ], 400);
        }else {
            //if not then check if the user exists in the database
            $user = User::where('username', $request->username)->first();
            if($user){
                return response()->json([
                    "status" => "user already exists",
                    "results" => []
                ], 400);
            }else{
                $user = new User;
                $user->username = $request->username ? $request->username : $user->username;
                $user->email = $request->email ? $request->email : $user->email;
                $user->password = bcrypt($request->password) ? bcrypt($request->password) : $user->password;

                if($user->save()){
                    return response()->json([
                        "status" => "user creation success",
                        "results" => ""//here i will return the jwt token
                    ], 200);
                }else {
                    return response()->json([
                        "status" => "user creation failed",
                        "results" => []
                    ], 400);
                }
            }
        }
    }

    function signIn(Request $request){
        //must validate user input
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){ //if validation fails then return error
            return response()->json([
                "status" => "failed",
                "results" => []
            ], 400);
        }else {
            //if not then check if the user exists in the database
            $user = User::where('username', $request->username)->first();
            if($user){
                return response()->json([
                    "status" => "success",
                    "results" => ""//here i will return the jwt token
                ], 200);
            }else{
                return response()->json([
                    "status" => "failed",
                    "results" => []
                ], 400);
            }
        }        
    }
}
