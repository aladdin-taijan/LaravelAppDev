@extends('layout.master')
@section('title','News Feed')
@section('header','Add Feed on our form')
    
@section('projects')

    <div class="container">
        @if (Session::has('message'))
            <span class="alert alert-warning"></span>
        @endif
    </div>
    
@endsection