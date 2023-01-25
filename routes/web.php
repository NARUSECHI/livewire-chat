<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Chat\CreateChat;
use App\Http\Livewire\Chat\Main;


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

Auth::routes();

Route::group(['middleware' => 'auth'],function(){
    Route::get('/',function(){
        return view('home');
    });

    //livewire
    Route::get('/users',[CreateChat::class,'render'])->name('users');
    Route::get('/chat(key?)',[Main::class,'render'])->name('chat');
});
