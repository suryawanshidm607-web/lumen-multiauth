<?php

namespace App\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use App\Models\Comment;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{
     use Authenticatable, Authorizable, HasFactory;

     protected $fillable = [
        'title', 'body',
    ];

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

}
