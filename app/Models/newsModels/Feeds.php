<?php

namespace App\Models\newsModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\at;

class Feeds extends Model
{
    use HasFactory;
    protected $table='feeds';

    protected $fillable = array('feed', 'title', 'active','category');

    public $timestamps = true;
}
