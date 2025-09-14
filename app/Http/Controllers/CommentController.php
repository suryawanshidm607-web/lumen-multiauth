<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Video;
use App\Models\Comment;

class CommentController extends Controller
{
    use ApiResponse;

     /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Display all posts
     */
    public function store(Request $request){
        $id   = $request->get('id');
        $type = $request->get('type');
        $comment = $request->get("comment");

        $typeMap = ['post'  => \App\Models\Post::class,
                    'video' =>  \App\Models\Video::class,
                   ];
        
        if (!array_key_exists($type, $typeMap)) {
            return $this->errorResponse('Invalid type provided', Response::HTTP_BAD_REQUEST);
        }
        
        $modelClass = $typeMap[$type];

        $model      = $modelClass::findOrFail($id);
        $NewComment    = $model->comments()->create([
                        'body' => $comment,
                        'commentable_type' => $modelClass,
                        'commentable_id'=> $id
                        ]);


        if (!$NewComment) {
            return $this->errorResponse('There is no comment for this post', Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse($NewComment);
                   


        
    }
     
    public function show(Request $request)
    {
        
        $id   = $request->get('id');
        $type = $request->get('type');
        
        
        $typeMap = ['post'  => \App\Models\Post::class,
                    'video' =>  \App\Models\Video::class,
                   ];
        
        if (!array_key_exists($type, $typeMap)) {
            return $this->errorResponse('Invalid type provided', Response::HTTP_BAD_REQUEST);
        }

        $modelClass = $typeMap[$type];
       
                
        $comments = Comment::select('id', 'body', 'commentable_id', 'commentable_type') // only these columns
                    ->with('commentable:id,title,body')
                    ->where('commentable_type',$modelClass)
                    ->where('commentable_id',$id)
                    ->first();
        if (!$comments) {
            return $this->errorResponse('There is no comment for this post', Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse($comments);
    }

    public function update(Request $request){
        $id             = $request->get('id');
        $type           = $request->get('type');
        $commentable_id = $request->get('commentable_id');
        $Reqcomment        = $request->get('comment');
        
        $typeMap = ['post'  => \App\Models\Post::class,
                    'video' =>  \App\Models\Video::class,
                   ];
        
        if (!array_key_exists($type, $typeMap)) {
            return $this->errorResponse('Invalid type provided', Response::HTTP_BAD_REQUEST);
        }

        $modelClass = $typeMap[$type];

        $model = $modelClass::findOrFail($commentable_id);

        $comment = $model->comments()->where('id', $id)->first();

        if (! $comment) {
         return $this->errorResponse('There is no comment for this '.$type, Response::HTTP_NOT_FOUND);
        }

        $comment = $comment->update([
                     'body' => $Reqcomment,
                   ]);
        
        if (!$comment) {
            return $this->errorResponse('There is no comment for this post', Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse($comment);            
    }
}
