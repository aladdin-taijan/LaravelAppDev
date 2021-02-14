<?php

namespace App\Models\postModels;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table= 'posts';
    
    protected $fillable = array('title','content' , 'author_id','share');

    public $timestamps = true;

    public function Author(){
        return $this->belongsTo(User::class,'author_id');
    }
    
}
