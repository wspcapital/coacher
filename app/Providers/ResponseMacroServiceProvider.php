<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($message = 'ok', $data = null) {
            return Response::json([
                'HTTP Status Code' => 200,
                "message" => $message,
                'data' => $data,
            ], 200);
        });

        Response::macro('error', function ($message, $status = 400) {
            return Response::json([
                'HTTP Status Code' => $status,
                'message' => $message,
            ], $status);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
