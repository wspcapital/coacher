<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

/**
 * Class BaseChatController
 * @package App\Http\Controllers
 */
class BaseChatController extends Controller
{
    /**
     * @var
     */
    public $authUserId;

    /**
     * BaseChatController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authUserId = Auth::user()->id;

            return $next($request);
        });
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth()
    {
        return response()->json([
            'auth' => Auth::check()
        ]);
    }
}
