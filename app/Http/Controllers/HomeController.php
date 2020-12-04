<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Category;
use Illuminate\Http\Request;
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
        dd('this is root path');
    }

    public function index()
    {
        //$data = Posts::all();
    
        $data = Posts::where('user_id',auth()->id())->orderBy('id','desc')->get();
        //$data = Posts::latest()->first();
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
        Posts::create($validated);

        return redirect('/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $post)
    {   
        //if($post->user_id != auth()->id()) abort(403); 

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
