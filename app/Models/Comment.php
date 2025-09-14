<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['body'];

    public function commentable(){
        return $this->morphTo();
    }
}
