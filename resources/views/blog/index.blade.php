@extends('layout.master')
@section('title','Personal Blog')
@section('header','Welcome to our Personal Blog System')
    


@section('projects')

    <section class="container">
        <div class="content">
            @if (Session::has('success'))
            <div class="alert alert-info" >
                {{Session::get('success')}}
            </div> 
               
            @endif
            
        <h1>Welcome  {{Auth::user()->name}}  </h1>
        <h5>To add New post click <a href="{{URL('blog/addpost')}}">here</a></h5>
        <!--Check if user has own post and return message about it-->
        @if (!empty($info))
            
       
        <div class="alert alert-info" >
            {{$info ?? ''}}
        </div>   
        @endif 
        <div class="container table-bordered table-hover">
            
           
        
            @foreach ($userposts as $item)
            <div class="row table-bordered">
                <div class="col-12">
                    <h4>{{$item->title}}</h4>
                </div>
                <div class="col-12">
                    <p>{{$item->content}}</p>
                    <hr>
                </div>
                <div class="col-12">
                    <p>
                    <small>This post is added by <span class="text-danger">{{$item->Author->name}}</span>
                    <br/>This  post is created at: <span class="text-info">{{$item->created_at}}</span>
                    <br/>This  post is updated at: <span class="text-info">{{$item->updated_at}}</span></small></p>
                    <hr>
                </div>    
                <div class="col-12">
                    @if (Auth::user()->id == $item->author_id)
                        
                    
                    <p>
                    
                    <a href="{{asset('/blog/delete')."/".$item->id}}" >
                    <button class="badge badge-danger">Delete this Post</button>
                    </a>
                    </p>
                    @endif
                </div>
            </div>
            @endforeach
            
        </div>
        <div class="d-flex justify-content-center">
            {{ $userposts->links() }}
        </div>
        </div>
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
         
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                $(this).remove(); 
            });
        }, 5000);
         
        });
        </script>
@endsection
