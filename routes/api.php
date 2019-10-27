<?php

use Illuminate\Http\Request;


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

Route::middleware(["cache.apiresponses"])->group(function () {
    Route::apiResource('/films', 'FilmsController')->only(['index']);
    Route::apiResource('/films/{film_episode_id}/characters', 'CharactersController')->only(['index']);
});

Route::apiResource('/films/{film_episode_id}/comments', 'CommentsController')->only(['index', 'store']);


Route::fallback(function(){
    return response()->json([
        'error' => 'Page Not Found. Check documentation for valid routes'], 404);
});