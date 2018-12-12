<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    App\Models\Category,
    App\Models\Lib;

class LibController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getLibDetails(Request $request)
    {
        $categoryId = $request->input('category');

        $childCategories = false;
        $childCategories = Category::where('parent_id', '=', $categoryId)->where('type', '=', 'Library')->get();

        $listLibs = false;
        $listLibs = Lib::where('category_id', '=', $categoryId)->get();

        return ['child_categories'=>$childCategories, 'list_libs'=>$listLibs];
    }
}
