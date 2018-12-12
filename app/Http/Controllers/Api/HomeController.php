<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request,
    App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getEventsTab(Request $request)
    {
        return Post::where('title', htmlspecialchars_decode($request->title))->first();
    }
}
