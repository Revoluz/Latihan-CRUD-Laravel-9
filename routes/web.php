<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogController1;

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

// Route::get('/welcome', function () {
//     return view('welcome');
// });

// Route::get('/',[BlogController::class,'index']);
// Route::get('/tambah-post',[BlogController::class,'create'])->name('pos');
//jika memakai name tidak perlu memakai url tetapi memakai route
// Route::post('/store-post',[BlogController::class,'store'])->name('tambah.post');
Route::resource('/post',BlogController::class);

