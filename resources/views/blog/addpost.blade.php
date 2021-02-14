@extends('layout.master')
@section('title','Personal Blog')
@section('header','Welcome to our Personal Blog System')
    


@section('projects')

    <section class="container">
        <div class="content">
            @if (Session::has('info'))
            <div class="alert alert-danger" id='alert'>
                {{Session::get('info')}}
            </div>    
            
                
            @endif
        <h1>Welcome  {{Auth::user()->name}} to Admin Area </h1>
        <form name="add_post" method="POST" action="{{URL::route('add_new_post')}}">
            @csrf
        <p><input class="form-control" type="text" name="title" placeholder="Post Title" value="{{old('title')}}"/></p>
        @error('title')
        <div class="alert alert-danger"><small>{{$message}}</small></div>
        @enderror
        <p><textarea class="form-control"    rows="5" name="content" placeholder="Post Content"></textarea></p>
        @error('content')
        <div class="alert alert-danger"><small>{{$message}}</small></div>
        @enderror
        <p><input  type="checkbox"  name="share" value=1>
            <label class="form-check-label" for="share">
                Share this Post
              </label>
        </p>
        <p><input type="submit" name="submit" class="btn btn-primary" /></p>
        
        </form>
        </div>
        
    </section>
@endsection