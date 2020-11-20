<?php

namespace App\Http\Controllers;


use App\Models\Posts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = Posts::all();
        //dd($data); //dump and die
        return view('home',compact('data'));
    }

    public function about(){
        $data = [
            'contact_key'=>'contact_value'
        ];
        return view('contact',compact('data'));
    }

    public function contact(){
        $data = [
            'about_key'=>'about_value'
        ];
        return view('about',compact('data'));
    }
}
