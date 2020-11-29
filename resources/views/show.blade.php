@extends('layout')

@section('content')
    <div class='container'>
        <div class="card">
            <div class="card-header" style='text-align:center'>
                Contents
            </div>
            <div class="card-body">
                    <div>
                        <h5 class="card-title">{{ $post->name }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                    </div>
                    <br>
            </div>
        </div>
        <br>
        <div>
            <a href='/posts' class='btn btn-success'>Back</a>
        </div>
    </div>
@endsection   
<!-- test test  -->