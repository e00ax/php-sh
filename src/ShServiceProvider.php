<?php

namespace E00ax\Sh;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ShServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //...
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    		$this->loadRoutesFrom(__DIR__.'/routes/web.php');
    		
        // Publish all
        $this->publishes([
            // Config
            __DIR__.'/config/sh.php' => base_path('sh.php'),
            __DIR__.'/config/scenes.php' => base_path('scenes.php'),

            // Exceptions
            __DIR__.'/Exceptions' => base_path('app/Exceptions'),

            // Helpers
            __DIR__.'/Helpers' => base_path('app/Helpers'),

            // Controllers
            __DIR__.'/Http/Controllers' => base_path('app/Http/Controllers'),

            // Composers
            __DIR__.'/Http/View/Composers' => base_path('app/Http/View/Composers'),

            // Providers
            __DIR__.'/Providers' => base_path('app/Providers'),

            // Resources
            __DIR__.'/resources/lang' => base_path('resources/lang'),
            __DIR__.'/resources/views' => base_path('resources/views'),

            // Routes
            //__DIR__.'/routes' => base_path('routes'),

            // Assets
            __DIR__.'/public' => base_path('public'),
        ]);
    }
}
