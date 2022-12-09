<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\FavoriteController;
use App\Http\Controllers\User\GameController;
use App\Http\Controllers\User\LoungeController;
use App\Http\Controllers\User\SearchController;
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
            Route::post('addUser/{id?}', [Usercontroller::class, 'addorUpdateUser']);
            //delete user
            Route::post('deleteUser/{id?}', [Usercontroller::class, 'deleteUser']);

            Route::group(['prefix' => 'games'], function(){
                //add games
                Route::post('addGame/{id?}'. [GameController::class,'addGameOrUpdateGame']);
                //delete games
                Route::post('deleteGame/{id?}', [GameController::class,'deleteGame']);
            });
            Route::group(['prefix' => 'favorites'],function(){
                //dk yet
            });
            Route::group(['prefix' => 'searches'], function(){
                //dk yet
                //block keywords (apple inspired)
            });
            Route::group(['prefix' => 'lounges'], function(){
                //add/update lounge
                Route::post('addLounge/{id?}', [LoungeController::class, 'addOrUpdateLounge']);
                //delete lounge
                Route::post('deleteLounge/{id?}', [LoungeController::class, 'deleteLounge']);
            });        
    });
    Route::group(['prefix' => 'user'], function(){
            //signup
            Route::post('signup', [UserController::class, 'addOrUpdateUser']);
            //signin
            Route::post('signin',[UserController::class, 'signIn']);
        Route::group(['prefix' => 'lounges'], function(){
            //get  lounges
            Route::get('lounges/{id?}',[LoungeController::class,'getLounges']);

            Route::group(['prefix' => 'lounge'], function(){
                //get lounge picutres by order
                Route::get('lounge',[LoungeController::class, 'getPicturesByOrder']);
                //get ratings
                Route::get('ratings',[LoungeController::class, 'getRatings']);
                //get location
                Route::get('location',[LoungeController::class,'getLocation']);
                //get reviews
                Route::get('reviews', [LoungeController::class,'getReviews']);
                //add review
                Route::post('review',[LoungeController::class,'addReview']);
            });
        });
        Route::group(['prefix' => 'games'], function(){
            //get games
            Route::get('games',[GameController::class,'getGames']);
        });
        Route::group(['prefix' => 'favorites'],function(){
            //get favorites by type
            Route::get('favorites',[FavoriteController::class,'getFavoritesByType']);

        });
        Route::group(['prefix' => 'searches'], function(){
            //display search
            Route::get('search',[SearchController::class,'getSearch']);
            //display keywords
            Route::get('keywords',[SearchController::class,'getKeywords']);
        });
    });
});