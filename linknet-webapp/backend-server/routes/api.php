<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'v0.1'], function(){
    Route::group(['prefix' => 'admin']. function(){
            //add/update user
            // Route::post("add/{id?}", [Usercontroller::class, "addorUpdateUser"]);
            //delete user
            // Route::post("delete/{id?}", [Usercontroller::class, "deleteUser"]);
            Route::group(['prefix' => 'games'], function(){
                //add games
            });
            Route::group(['prefix' => 'favorites'],function(){        
                
            });
            Route::group(['prefix' => 'searches'], function(){
        
            });
            Route::group(['prefix' => 'lounges'], function(){
                //add/update lounge
                //Route::post("add/{id?}", [LoungeController::class, "addorUpdateLounge"]);
                //delete lounge
                //Route::post("delete/{id?}", [LoungeController::class, "deleteLounge"]);
                //add decription
                //add image with order
            });        
    });
    Route::group(['prefix' => 'user'], function(){
            //edit profile {bio pciture email password username}
            //update location
        Route::group(['prefix' => 'lounges'], function(){
            //display  lounges
            Route::group(['prefix' => 'lounge'], function(){
                //display lounge picutres by order
                //display ratings
                //display location
                //display reviews
                //add review
            });
        });
        Route::group(['prefix' => 'games'], function(){
            //display games
        });
        Route::group(['prefix' => 'favorites'],function(){
            //display favorites by type

        });
        Route::group(['prefix' => 'searches'], function(){
            //display search
            //display keywords
        });
    });
});