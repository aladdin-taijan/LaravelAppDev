<?php

namespace App\Http\Controllers\news;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedsController extends Controller
{
    //this method to show form to add new feed
    public function getCreate(){
        return view('news.create_feed');
    }
}
