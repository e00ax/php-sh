<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class HueLightsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            [
                'hue.quickSetLayout',
                'hue.lights.lights',
                'hue.lights.delete',
                'hue.groups.groups',
                'hue.groups.create'
            ],
            'App\Http\View\Composers\HueLightsComposer'
        );
    }
}
