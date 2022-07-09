<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function getBySlug($slug)
    {
        return  Post::where('slug', '=', $slug)->first();
    }

    public function get()
    {
        return Post::all();
    }
}
