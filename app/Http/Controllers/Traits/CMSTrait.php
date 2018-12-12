<?php

namespace App\Http\Controllers\Traits;

use App\Models\Post,
    Illuminate\Support\Facades\App;

/**
 * Class CMSTrait
 * @package App\Http\Controllers\Traits
 */
trait CMSTrait
{
    /**
     * Return posts from DB
     *
     * @param string $alias
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPost($alias)
    {
        return Post::where('alias', $alias)
            ->where('visible', '1')
            ->where('lang', App::getLocale())
            ->get();
    }

    /**
     * Return posts
     *
     * @param string $alias
     * @return array
     */
    public function getArrayPost($alias):array
    {
        $arrPost = [];
        foreach ($this->getPost($alias) as $post) {
            $arrPost[$post->subtitle] = $post;
        }

        return $arrPost;
    }

    /**
     * Return one post
     *
     * @param string $alias
     * @return mixed
     */
    public function getOnePost($alias)
    {
        return Post::where('alias', $alias)
            ->where('visible', '1')
            ->where('lang', App::getLocale())
            ->first();
    }
}
