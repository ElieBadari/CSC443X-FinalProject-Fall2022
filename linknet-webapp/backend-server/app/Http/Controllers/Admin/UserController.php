<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller {
    

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['signUp','signIn']]);
    }

    //###################################################
    // these are reg user functions
    //###################################################
    
    public function signIn(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        $token = Auth::attempt($credentials);
        
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();

        if  ($user->user_type_id == 0){
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'role' => 'admin',
                    'type' => 'bearer',
                ]
            ]);
        }else if ($user->user_type_id == 1){
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'role' => 'lounge',
                    'type' => 'bearer',
                ]
            ]);
        }else {
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'role' => 'gamer',
                    'type' => 'bearer',
                ]
            ]);
        }
    }

    public function signUp(Request $request){

        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'username' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    //###################################################
    // these are admin only functions
    //###################################################

    public function addorUpdateUser(Request $request, $id = null){
        
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'user_type_id' => 'integer',
            'locations' => 'array',
            'pic_url' => 'string',
            'bio' => 'string'
        ]);

        $credentials = $request->only('username', 'password');

        $token = Auth::attempt($credentials);

        if (!$id){//if the id is null then we are adding a user else we are updating one
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

}
