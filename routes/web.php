<?php

use Illuminate\Support\Facades\Route;

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



\Illuminate\Support\Facades\Auth::routes();

Route::view('/', 'welcome');




Auth::routes();



Route::middleware('auth')->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/users',[\App\Http\Controllers\TelegramUsersController::class,'index'] )->name('users');
    Route::get('/milk',[\App\Http\Controllers\MilkControllers::class,'index'] )->name('milk');
    Route::get('/sticks',[\App\Http\Controllers\SticksController::class,'index'] )->name('sticks');
});


Route::prefix('/update')->group(function (){
    Route::get('/milk',[\App\Http\Controllers\MilkControllers::class,'update'])->name('milk.update');
    Route::get('/sticks',[\App\Http\Controllers\SticksController::class,'update'])->name('sticks.update');


});


Route::post('/addmilkuser',[\App\Http\Controllers\MilkControllers::class, 'create'])->name('milkuser.add');
Route::post('/addstickuser',[\App\Http\Controllers\SticksController::class,'createStickUser'])->name('addStickUser');

Route::get('/delete', [\App\Http\Controllers\SticksController::class,'delete'])->name('delete');
Route::delete('/destroy/{id}', [\App\Http\Controllers\SticksController::class,'destroy'])->name('destroy');


Route::get('/deleteMik', [\App\Http\Controllers\MilkControllers::class,'delete'])->name('deleteMilk');
Route::delete('/destroyMilk/{id}', [\App\Http\Controllers\MilkControllers::class,'destroy'])->name('destroyMilk');

