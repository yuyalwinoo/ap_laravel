<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('welcome/welcomesub', function () {
//     //return view('welcome');
//     return 'welcome  from laravel sub view';
// });

// Route::get('contact', function () {
//     //$data = 'some data';
//     //$data = "<script>alert('boom')</script>";
//     $data = request('name'); //http://127.0.0.1:8000/contact?name=yuya
//     return view('contact',['data'=>$data]);
// });

// Route::get('contact/{name}', function ($name) {      with parameter
//     return $name;
// });


// Route::get('/', function () {
//     $data = [
//         'home_key'=>'home_value'
//     ];
//     return view('home',compact('data'));
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('about', [HomeController::class, 'about']);
Route::get('contact', [HomeController::class, 'contact']);


