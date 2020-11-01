<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class HueSensorsServiceProvider extends ServiceProvider
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
                'hue.sensors.sensors',
                'hue.sensors.delete',
                'hue.rules.dimmerSwitchLayout'
            ],
            'App\Http\View\Composers\HueSensorsComposer'
        );
    }
}
