<?php

namespace App\Http\View\Composers;

//use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TemphumComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        //...
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $last = DB::table('dht22')
            ->orderBy('id', 'desc')
            ->first();

        $view->with('last', $last);
    }
}
