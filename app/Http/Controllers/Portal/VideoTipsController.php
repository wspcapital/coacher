<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request,
    App\Http\Controllers\Controller,
    App\Models\Lib;

class VideoTipsController extends Controller
{
    public function getIndex()
    {
        return view('portal.video-tips')->with([
            'videos' => Lib::where('category_id', '=', 38)->with('asset')->get()
        ]);
    }
}
