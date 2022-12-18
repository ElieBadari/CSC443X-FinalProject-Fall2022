<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\User;

class FavoriteController extends Controller
{
    function getFavoritesByType(Request $request, $id){//this might need editing once i get the front end working and jwt too
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'status' => 'user not found'
            ]);
        }else{
            $favorites = Favorite::where('user_id', $user->user_id)
                                    ->where('entity_type', $request->entity_type)
                                    ->get();
            if($favorites->isEmpty()){
                return response()->json([
                    'status' => 'no favorites found'
                ]);
            }else{
                return response()->json([
                    'status' => 'success',
                    'results' => $favorites
                ]);
            }
        }
    }
}
