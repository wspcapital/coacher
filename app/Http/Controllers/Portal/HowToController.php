<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;

class HowToController extends Controller
{
    public function getIndex()
    {
        return view('portal/howto');
    }
}
