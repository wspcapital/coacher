<?php

namespace App\Http\Controllers\Portal;

use App\Models\Traits\LaratrustCustomTrait;
use App\Models\Traits\UserTrait;
use App\Models\User;
use Illuminate\Http\Request,
    App\Http\Requests,
    App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * Class HomeController
 * @package App\Http\Controllers\Portal
 */
class HomeController extends Controller
{
    use LaratrustCustomTrait;

    public function getIndex()
    {
        $trainers = $this->getTrainersList();

        return view('portal.index', [
            'trainer' => $trainers[rand(0, $trainers->count() - 1)]
        ]);
    }
}
