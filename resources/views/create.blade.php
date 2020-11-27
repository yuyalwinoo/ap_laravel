@extends('layout')

@section('content')
    <div class='container'>
        
        <div class="card">
            <div class="card-header" style='text-align:center'>
                New Post
            </div>
            <div class="card-body">
            <!-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->
            <form action="/posts" method="post">
                @csrf <!--add token value -->
                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="name" name='name' placeholder='Enter Name' 
                    value="{{old('name')}}">
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="exampleInputDes">Description</label>
                    <textarea class="form-control" name='des'>{{old('des')}}</textarea>
                </div>
                @error('des')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href='/posts' class='btn btn-success'>Back</a>
                </form>
                
            </div>
        </div>
    </div>
@endsection    