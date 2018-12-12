<?php

namespace App\Http\Controllers\Api;

use App\Models\User,
    Illuminate\Http\Request,
    App\Http\Requests,
    App\Http\Controllers\Controller;

/**
 * Class SearchController
 * @package App\Http\Controllers\Api
 */
class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return $this
     */
    public function search(Request $request)
    {
        return User::search($request->get('q'))->paginate(20);
       // $user->load('rm', 'roles');
        /*// First we define the error message we are going to show if no keywords
        // existed or if no results found.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if ($request->has('q')) {
            // Using the Laravel Scout syntax to search the products table.
            $users = User::search($request->get('q'))->get();
            // If there are results return them, if none, return the error message.
            return $users->count() ? $users : $error;
        }
        // Return the error message if no keywords existed
        return $error;*/
    }
}
