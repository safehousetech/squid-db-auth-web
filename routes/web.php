<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gui\UserController;
use App\Http\Controllers\Gui\SquidAllowedIpController;
use App\Http\Controllers\Gui\SquidUserController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register'=>false
]);

Route::group(['middleware' => 'auth:web'], function()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['prefix'=>'user'],function(){
        Route::post('create',[UserController::class,'create'])->name('user.create');
        Route::post('modify/{id}',[UserController::class,'modify'])->name('user.modify');
        Route::post('destroy/{id}',[UserController::class,'destroy'])->name('user.destroy');
        Route::get('search',[UserController::class,'search'])->name('user.search');
        Route::get('creator',[UserController::class,'creator'])->name('user.creator');
        Route::get('editor/{id}',[UserController::class,'editor'])->name('user.editor');
    });
    Route::group(['prefix'=>'squidallowedip'],function(){
        Route::get('search/to_specified_user/{user_id}',[SquidAllowedIpController::class,'search'])->name('ip.search');
        Route::get('creator',[SquidAllowedIpController::class,'creator'])->name('ip.creator');
        Route::get('editor/{id}',[SquidAllowedIpController::class,'editor'])->name('ip.editor');
        Route::post('create/to_specified_user/{user_id}',[SquidAllowedIpController::class,'create'])->name('ip.create');
        Route::post('destroy/{id}',[SquidAllowedIpController::class,'destroy'])->name('ip.destroy');
    });
    Route::group(['prefix'=>'squiduser'],function(){
        Route::get('search/to_specified_user/{user_id}',[SquidUserController::class,'search'])->name('squiduser.search');
        Route::get('creator',[SquidUserController::class,'creator'])->name('squiduser.creator');
        Route::get('editor/{id}',[SquidUserController::class,'editor'])->name('squiduser.editor');
        Route::post('create/to_specified_user/{user_id}',[SquidUserController::class,'create'])->name('squiduser.create');
        Route::post('modify/{id}',[SquidUserController::class,'modify'])->name('squiduser.modify');
        Route::post('destroy/{id}',[SquidUserController::class,'destroy'])->name('squiduser.destroy');
    });
});

