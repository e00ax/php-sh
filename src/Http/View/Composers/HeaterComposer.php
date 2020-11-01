<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class HeaterComposer extends \App\Http\Controllers\HeaterController
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        // Get temp from ini file
        $temp = $this->iniFile['manual']['temp'];

        return $view
            ->with('heaterState', $this->getStatePigpio())
            ->with('heaterTemp', $temp);
    }
}
