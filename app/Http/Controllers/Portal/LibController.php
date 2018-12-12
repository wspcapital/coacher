<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    App\Models\Category;

class LibController extends Controller
{
    public function getIndex()
    {
        return view('portal.libs')->with([
            'categories' => Category::where('type', 'Library')
                ->where('parent_id', 39)
                ->where('blocked', '0')
                ->with('lib.asset.media')
                ->get()
        ]);
    }
}
