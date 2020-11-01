<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class HueGroupsServiceProvider extends ServiceProvider
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
                'hue.groups.groups',
                'hue.groups.create',
                'hue.groups.delete',
                'hue.rules.dimmerSwitchLayout'
            ],
            'App\Http\View\Composers\HueGroupsComposer'
        );
    }
}
