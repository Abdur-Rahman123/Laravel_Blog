<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
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
Route::get('/detail/{slug}/{id}',[HomeController::class,'detail']);
Route::get('manage-posts',[HomeController::class,'manage_posts']);
//Admin Route
Route::get('/admin/login',[AdminController::class,'login']);
Route::get('/admin/logout',[AdminController::class,'logout']);
Route::post('/admin/login',[AdminController::class,'submit_login']);

Route::get('/admin/dashbord',[AdminController::class,'dashbord']);
// Post
Route::get('admin/user',[AdminController::class,'users']);
Route::get('admin/user/delete/{id}',[AdminController::class,'delete_user']);
// Comment
Route::get('admin/comment',[AdminController::class,'comments']);
Route::get('admin/comment/delete/{id}',[AdminController::class,'delete_comment']);
//Category
Route::resource('/admin/category',CategoryController::class);
Route::get('/admin/category/{id}/delete',[CategoryController::class,'destroy']);

//post
Route::resource('/admin/post',PostController::class);
Route::get('/admin/post/{id}/delete',[PostController::class,'destroy']);
//session
Route::get('/admin/logout',[AdminController::class,'logout']);
//setting
Route::get('/admin/setting',[SettingController::class,'index']);
Route::post('/admin/setting',[SettingController::class,'save_settings']);
//Home
Route::get('/',[HomeController::class,'index']);
Route::post('/save-comment/{slug}/{id}',[HomeController::class,'save_comment']);
Route::get('/category/{slug}/{id}',[HomeController::class,'category']);
Route::get('/all-categories',[HomeController::class,'all_category']);
Route::get('save-post-form',[HomeController::class,'save_post_form']);
Route::post('save-post-form',[HomeController::class,'save_post_data']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
