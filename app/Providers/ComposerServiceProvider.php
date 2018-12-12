<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider,
    Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('intranet.template.partials.left-block', 'App\Http\ViewComposers\IntranetComposer');
        View::composer('portal.template.partials.left-block', 'App\Http\ViewComposers\PortalComposer');
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
