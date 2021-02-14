@extends('layout.master')
@section('title','Main Page')
@section('header','Welcome to our Image Share system')
    


@section('projects')

    <div class="container">

      @if (Session::has('warning'))
      <div class="alert alert-warning text-right">{{Session::get('warning')}}</div>
      @endif
      <br>
            
      <a href="{{asset('imageshare/imageadd')}}">
        <h6><span class="badge badge-primary">Upload new Image</span></h6>
      </a>
      
      <div class="row table-border">
        @foreach ($allimages as $item)
        <div class="col-3">
          <a href="{{asset('imageshare/imageshow'."/".$item->id)}}">
          <img src=" {{asset('thumbnail')."/".$item->image}}" alt="" class="img-thumbnail">
          </a>
        </div>      
        @endforeach
        
      </div>
      <div  class="d-flex justify-content-center">{{$allimages->links()}}</div>    
    </div>
@endsection