<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Http\Requests\storePostRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function testRoot()
    {
        dd('this is root path');
    }

    public function index()
    {
        //$data = Posts::all();
        $data = Posts::orderBy('id','desc')->get();
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
        return view('create');
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

        $post = new Posts();
        // tablefieldname = parameter name from $request
        $post->name = $request->name;
        $post->description = $request->des;

        $post->save();

        // Posts::create([
        //     'name' => $request->name,
        //     'description' => $request->des
        // ]);

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
        dd($post->categories->name);
        //$post = Posts::findOrFail($id);
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
        return view('edit',compact('post'));
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
        $post->name = $request->name;
        $post->description = $request->des;
        $post->save();
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
