<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;

class SharedVideoController extends Controller
{
    public function getIndex()
    {
        return view('intranet.shared-video');
    }
}
