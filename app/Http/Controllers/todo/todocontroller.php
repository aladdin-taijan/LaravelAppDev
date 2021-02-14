<?php

namespace App\Http\Controllers\todo;

use App\Http\Controllers\Controller;
use App\Models\todoModles\todo;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class todocontroller extends Controller
{
    //th
    //public $restfull = true ;
    public function postAdd(Request $request){
    if($request->ajax()){
    $todo= new todo();
    $todo->title = $request->input("title");

    $todo->save();
    
    $last_todo = $todo->id;
    
    $todos = todo::whereId($last_todo)->get();
    
    return view('todo/ajaxData')->with("todos",$todos);
    }
    }
    public function postUpdate(Request $request ,$id) {
        if($request->ajax()){
        $task = Todo::find($id);
        $task->title = $request->input("title");// Input::get("title");
        $task->save();
        return "OK";
    }
    }
    public function getIndex() {
        $todos = Todo::all();
        return view("todo/index")->with("todos", $todos);
    }

    public function getDelete(Request $request, $id) {
        if($request->ajax()){
        $todo = Todo::whereId($id)->first();
        $todo->delete();
        return "OK";
        }
        }
    public function getDone(Request $request, $id) {
        if($request->ajax()){
        $task = Todo::find(4);
        
        $task->status = '1' ;
        $task->save();
        return "OK";
        }
    }

    

}
