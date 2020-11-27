@extends('layout')

@section('content')
    <div class='container'>
        
        <div class="card">
            <div class="card-header" style='text-align:center'>
                Edit Post
            </div>
            <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/posts/{{$post->id}}" method="post">
                @csrf <!--add token value -->
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input value="{{old('name', $post->name)}}" type="text" class="form-control" id="name" name='name' placeholder='Enter Name'>
                </div>
                <div class="form-group">
                    <label for="exampleInputDes">Description</label>
                    <textarea class="form-control" name='des'>{{old('des',$post->description)}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href='/posts' class='btn btn-success'>Back</a>
                </form>
                
            </div>
        </div>
    </div>
@endsection    