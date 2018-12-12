<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    App\Models\Post;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllPosts()
    {
        return Post::with(['category'])->paginate(20);
    }
}
