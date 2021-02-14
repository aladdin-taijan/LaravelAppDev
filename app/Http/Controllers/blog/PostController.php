<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use App\Models\postModels\Posts;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    //this controller conatine all methode to manage Personal Blog
    //getIndex methode return all posts from logined user
    public function getIndex(){

      
      $userid=Auth::user()->id;
      
      $userposts=Posts::where('author_id',$userid)->orwhere('share',true)->with('Author')->paginate(2);
      $ownposts=Posts::where('author_id',$userid)->count();
     // $userposts = Posts::with(['Author' => function ($query) use ($userid) {
       // $query->where('id', $userid);}])->paginate(2);
    if ($ownposts == 0){
      return  view('blog.index',compact('userposts'))->with(['info'=>'You donot have any post please add first one.....']);
     }
     else
      return   view('blog.index',['userposts'=>$userposts]);  
    }

    //createpost methode return addpost view 
    public function createpost()
    {
        # code...
        return view('blog.addpost');
      // return redirect()->route('blogindex');
    }

    //postAdd methode get request and store into database 
    public function postAdd(Request $request){

      $rules=$this->getrules();
      $messages = $this->getmessages();

      $validate=validator::make($request->all(),$rules,$messages);
      
      if ($validate -> fails())
      return redirect()->back()->withErrors($validate)->withInput();
      else{
        Posts::create([
          'title' => $request->title,
          'content' => $request->content,
          'share' => $request->share,// ? 1 : 0 ?? 0,
          'author_id' => Auth::user()->id
        ]);
      }
      return $request->all(); //redirect('blog/index')->with(['success'=>'Post is posted']);
      
    }
    //this methode delete post with id provieded
    public function deletePost($id){
      $deletepost=Posts::destroy($id);
      if ($deletepost) return redirect('/blog/index')->with(['success'=>'Post is deleted']);


    }


    protected function getrules(){
      return $rules=[
          'title'=>"required|min:3",
          'content'=>"required|min:10"

      ];
    }
    protected function getmessages(){
      return $messages=[
        'title.required'=> "The title is required",
        'title.min'=> "The min letter is 3",
        'content.required'=>"The content is required",
        'content.min'=>"The min content is 10 letters"
      ];
    }
}
