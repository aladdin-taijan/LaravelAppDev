@extends('layout.master')
@section('title','Main Page')
@section('header','Welcome to our Image Share system')
    


@section('projects')
<div class="container">
    @if(Session::has('success'))
    <h3 class="error">{{$success->first()}}</h3>
    @endif
    {{--If there is an error flashdata in session which
    is set manually, we will show it--}}
    @if(Session::has('error'))
    <h3 class="error">{{Session::get('error')}}</h3>
    @endif
    {{--If we have a success message to show, we print
    it--}}
    @if(Session::has('success'))
    <h3 class="error">{{Session::get('success')}}</h3>
    @endif
    
    <br>
    
        
            <form method="POST" action="{{route('store')}}"  enctype="multipart/form-data">
                @csrf
                <label for="">Please insert image title</label>
                <input class="form-control" type="text" name="title" placeholder="Please insert your title here">
                @error('title')
                <small class="alert alert-fail text-right">{{$message}}</small>
              @enderror
                <label for="">chosse your image</label>
                <input class="form-control" type="file" name="image" >
                <br />
                <input class="form-control" type="submit" value="save" name='send'><br>

            </form>
            
    </div>
@endsection