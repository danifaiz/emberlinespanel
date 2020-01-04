<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "HomeController@index");

Route::get("/admin/project/add","ProjectsController@create");
Route::get("/admin/project/{id}","ProjectsController@edit");
Route::post("/saveProject","ProjectsController@store");
Route::get("/admin/projects","ProjectsController@listProjects");
Route::delete('/admin/project/remove/{id}', "ProjectsController@destroy");
Route::delete('/admin/project/remove/image/{id}', "ProjectsController@destroyGalleryImage");

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get("/test","ProjectsController@test");

Route::get('/send/email', 'HomeController@mail');


