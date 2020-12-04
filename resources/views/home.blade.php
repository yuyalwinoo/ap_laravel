@extends('layout')

@section('content')
    <div class='container'>
        <div>
            <a href="{{ route('root') }}" class='btn btn-success'>Go To Root Path</a>
            <a href='/posts/create' class='btn btn-success'>New Post</a>
            <a href='/logout' class='btn btn-warning'>Logout</a>
            <p style='float:right'>{{Auth::user()->name}}</p>
        </div>
        <br>
        @foreach($data as $post)
        <div class="card">
            <div class="card-header" style='text-align:center;background-color:cyan'>
                <h5 class="card-title">Content {{ $post->id }}</h5>
            </div>
            <div class="card-body">
               
                    <div>
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        <div class='form-row'>
                            <a style="height: 40px;margin-right: 10px;" href="/posts/{{ $post->id }}" class="btn btn-primary">View</a>
                            <a style="height: 40px;margin-right: 10px;" href="/posts/{{ $post->id }}/edit" class="btn btn-warning">Edit</a>
                            <form action='/posts/{{$post->id}}' method='post'>
                                @csrf
                                @method('DELETE')
                                <button type='submit' class='btn btn-danger'>Delete</button>
                            </form>
                        </div>    
                    </div>
                
            </div>
        </div>
        <br>
        @endforeach
        
    </div>
@endsection    