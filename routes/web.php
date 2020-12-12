<?php

use App\Test;
use App\Container;
use App\TestFacade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// Route::get('/', [HomeController::class, 'index']);
// Route::get('about', [HomeController::class, 'about']);
// Route::get('contact', [HomeController::class, 'contact']);

Route::resource('posts',HomeController::class)->middleware(['auth:sanctum', 'verified']);
Route::get('logout',[AuthController::class,'logout']);

Route::get('/root',[HomeController::class,"testRoot"])->name('root');

// Route::get('/', function(){
//     $container = new Container();

//     $container->bind('test', function(){
//         return new Test();
//     });
//     $test = $container->resolve('test');
//     dd($test->smth());
// });

Route::get('/',function(Test $test){
    dd(resolve('test')->execute());
    //return TestFacade::execute();

    //$test = resolve('test');
    //$test = resolve(App\Test::class);
    //dd($test);
    return view('welcome');
    //return View::make('welcome');
});


