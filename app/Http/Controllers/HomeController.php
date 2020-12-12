<?php

namespace App\Http\Controllers;

use App\Test;
use App\Models\Posts;
use App\Mail\PostStored;
use App\Models\Category;
use App\Mail\PostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\storePostRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //$this->middleware('auth')->except('index','create');
        //$this->middleware('auth')->only('index','create');
        $this->middleware('auth');
    }

    public function testRoot()
    {
        $collection = collect(['taylor', 'abigail', null])->map(function ($name) {
            return strtoupper($name);
        });
        dd(Posts::pluck('name'));
        dd($collection);
        dd('this is root path');

    }

    public function index(Request $request)
    {
        //$data = Posts::all();
    
        $data = Posts::where('user_id',auth()->id())->orderBy('id','desc')->get();

        //$request->session()->flash('status', 'Task was successful!');

        //$data = Posts::latest()->first();

       //dd(config('mail.from.address'));

        // Mail::raw('Hello world',function($msg){
        //     $msg->to('yuya@gmail.com')->subject('AP Index Function');
        // });
        
        return view('home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request)
    {   
        //dd($request->all());
        //$validated = $request->validated();
        
        // $request->validate([
        //     'name' => 'required|unique:posts|max:255',
        //     'des' => 'required|max:255',
        // ]);

        // $post = new Posts();
        // // tablefieldname = parameter name from $request
        // $post->name = $request->name;
        // $post->description = $request->des;

        // $post->save();
            
        // Posts::create([
        //     'name' => $request->name,
        //     'description' => $request->des,
        //     'category_id' => $request->category,
        // ]);

        $validated = $request->validated();
       // dd($validated);
        $post = Posts::create($validated + ['user_id'=>auth()->id()]);
        //Mail::to('yuyal1593@gmail.com')->send(new PostCreated());//markdown
        //Mail::to('yuyal1593@gmail.com')->send(new PostStored($post));//html
        //return redirect('/posts')->with('status',$request->name.' was successfully created!');
        return redirect('/posts')->with('status',config('aprogrammer.message.success'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $post,Test $test)
    {   
        //if($post->user_id != auth()->id()) abort(403); 
        //dd($test);
        $this->authorize('view', $post);//with policy
        return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
       // $post = Posts::findOrFail($id);
        if($post->user_id != auth()->id()) abort(403);
        $categories = Category::all();
        return view('edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storePostRequest $request, Posts $post)
    {
        $validated = $request->validated();
        $post->update($validated);
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {   
        $post->delete();
        return redirect('/posts');
    }
}
