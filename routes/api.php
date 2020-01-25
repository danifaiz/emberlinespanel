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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("projects","ProjectsController@index");
Route::get("categories","ProjectsController@categories");
Route::get("bindTagToProject","ProjectsController@addCategoryToProject");
Route::get('project/{projectId}', 'ProjectsController@show');

Route::post('/sendInquiry', 'ProjectsController@mail');

Route::get("/setCloudinarySecureLinks","ProjectsController@setCloudinarySecureLinks");