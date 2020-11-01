<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class HueScenesComposer extends \App\Http\Controllers\HueController
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
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $url = $this->base_url . "/scenes";

        $response = Http::get($url);

        // HTTP call successful
        if ($response->successful()) {
            // [Debug]
            //print_r($response->json());

            $view->with('scenes', $response->json());
        // HTTP error
        } else {
            $msg = response()->json(['error'=> [
                'text' => 'HTTP request failed using hue lights rest api::compose()',
                'header' => $response->headers(),
                'status' => $response->status(),
                'status' => $response->body()
                ]
            ]);

            \Log::info($msg);
        }
    }
}
