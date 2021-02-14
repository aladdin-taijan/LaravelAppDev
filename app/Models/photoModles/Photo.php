<?php

namespace App\Models\photoModles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Contracts\Service\Attribute\Required;

class Photo extends Model
{
    use HasFactory;

    //Rules to Upload images
    public static $upload_rules = array(
        'title'=>'required|min:3',
        'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    );
}
