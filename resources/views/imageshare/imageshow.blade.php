@extends('layout.master')
@section('title','Main Page')
@section('header','Welcome to our Image Share system')

@section('projects')
<br>
<div class="container table-bordered table-hover">
    <div class="row table-bordered">
        <div class="col-4">
            <img src=" {{asset('thumbnail')."/".$imageinfo->image}}" alt="" class="img-thumbnail">
        </div>
        <div class="col-8 text-left">
            <div class="row">
                <div class="col-8">
                <h4>Image Title is: {{$imageinfo->title}}</h4>
                <h6>
                    <span class="badge badge-info ">Image URL</span>
                    <span>{{htmlentities(asset('imageupload')."/".$imageinfo->image)}}</span>
                </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <h6>
                    <span class="badge badge-info ">Thumbnail URL</span>  
                    <span>{{htmlentities(asset('thumbnail')."/".$imageinfo->image)}}</span>
                    </h6>
                </div>
            </div>
        </div>
        <a href="{{asset('imageshare/deleteimage/'.$imageinfo->id)}}">
        <button class="badge badge-danger">Delete this image</button>
    </div>
    
    
</div>


    
@endsection