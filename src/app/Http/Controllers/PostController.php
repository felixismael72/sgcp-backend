<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function getByID($postID)
    {
        return  Post::where('_id', '=', $postID)->first();
    }

    public function get()
    {
        return Post::all();
    }

    public function post(Request $request) 
    {
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->author = $request->author;

        $post->save();

        return response()->json(["id" => $post->id], 201);
    }

    public function put(Request $request, $postID) 
    {
       $post = Post::find($postID);
       $post->title = $request->title;
       $post->body = $request->body;
       $post->author = $request->author;
       $post->save();

       return response()->json([], 204);
    }

    public function delete($postID) {
        $post = Post::find($postID);

        $post->delete();

        return response()->json([], 204);
    }
}
