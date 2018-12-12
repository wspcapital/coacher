<?php

namespace App\Http\Controllers\Intranet;

use App\Models\{
    Category,
    Post
};
use Illuminate\Support\Facades\View,
    App\Http\Controllers\Controller,
    MercurySeries\Flashy\Flashy,
    App\Http\Requests\PostCreateRequest;

/**
 * Class PostController
 * @package App\Http\Controllers\Intranet
 */
class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllPosts()
    {
        $cmsCategories = [];
        foreach (Category::where('type', '=', 'CMS')->where('blocked', '=', '0')->get() as $category) {
            $cmsCategories[$category['id']] = $category['title'];
        }

        return view('intranet.posts')->with(['cmsCategories' => $cmsCategories]);
    }

    /**
     * @return mixed
     */
    public function getNewPost()
    {
        $aSelectCategories = [];
        if ($categories = Category::where('type', '=', 'CMS')->where('blocked', '=', '0')->get()) {
            foreach ($categories as $category) {
                $aSelectCategories[$category['id']] = $category['title'];
            }
        }

        return view('intranet.new-post')->with(['categories' => $aSelectCategories]);
    }

    /**
     * Return one post
     *
     * @param Post $post
     * @return View
     */
    public function getOnePost(Post $post)
    {
        $aSelectCategories = [];
        if ($categories = Category::where('type', '=', 'CMS')->where('blocked', '=', '0')->get()) {
            foreach ($categories as $category) {
                $aSelectCategories[$category['id']] = $category['title'];
            }
        }

        return view('intranet.post')->with(['categories' => $aSelectCategories, 'post' => $post]);
    }


    /**
     * Update post
     *
     * @param PostCreateRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePost(PostCreateRequest $request, Post $post)
    {
        if (empty($request->visible)) {
            $post->visible = '0';
        }
        $post->update($request->all());
        Flashy::message('Post update');

        return redirect()->back();
    }

    /**
     * Create Post
     *
     * @param PostCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createPost(PostCreateRequest $request)
    {
        $post = Post::create($request->all());

        Flashy::message('Post create');
        return redirect('intranet/post/' . $post->id);
    }
}
