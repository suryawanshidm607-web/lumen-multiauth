<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Video;
use App\Models\Comment;

class PostController extends Controller
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
    public function index()
    {
        $posts = Post::all();
       

        if ($posts->count() > 0) {
            return $this->successResponse($posts, Response::HTTP_OK);
        }

        return $this->errorResponse('No posts found', Response::HTTP_NOT_FOUND);
    }

    /**
     * Store a new post
     */
    public function store(Request $request)
    {
        // dd("dipalee");
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        $post = Post::create($request->only(['title','body']));

        $post->comments()->create(['body' => 'This is the first default comment for this post.']);

        return $this->successResponse($post, Response::HTTP_CREATED);
    }

    /**
     * Show a single post
     */
    public function show($post)
    {
        //  $post = Post::findOrFail($post);

         $post = Post::with('comments')->findOrFail($post);
        //  dd($post);

         if (!$post) {
            return $this->errorResponse('Post not found', Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse($post);
    }

    /**
     * Update a post
     */
    public function update(Request $request, $post)
    {
        // $post = Post::find($id);

        // if (!$post) {
        //     return $this->errorResponse('Post not found', Response::HTTP_NOT_FOUND);
        // }

        // $post->fill($request->all());
        // $post->save();

        // return $this->successResponse($post, Response::HTTP_OK);
    }

    /**
     * Delete a post
     */
    public function destroy($post)
    {
        // $post = Post::find($id);

        // if (!$post) {
        //     return $this->errorResponse('Post not found', Response::HTTP_NOT_FOUND);
        // }

        // $post->delete();

        // return $this->successResponse(null, Response::HTTP_NO_CONTENT);
    }
}
