<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HueEffectsController extends HueController
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
     * Display a listing of the resource.
     *
     * @return view
     */
    public function effects()
    {
        return view('hue.groups.groups');
    }


    /**
     * Set effects
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setEffects(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'lights' => 'required|array',
            'type' => 'required'
        ]);

        // Log everything
        //$input = $request->all();
        \Log::info($validatedData);

        if ($validatedData['type'] == 'lights') {
            $url = $this->base_url . "/lights/" . $validatedData['id'] . "/state";
        } elseif ($validatedData['type'] == 'groups') {
            $url = $this->base_url . "/groups/" . $validatedData['id'] . "/action";
        } else {
            echo "Wrong type!";
            exit(0);
        }

        return Http::put($url, config('effects.' . $validatedData['name']));
        
        // [Debug]
        print_r($request->input());
    }

    /**
     * Helper
     *
     * @param string $url
     * @param array $effect hue effect
     * @return \Illuminate\Http\Response
     */
    public function httpPut($url, $effect)
    {
        // Post asForm when no json body is available
        $response = Http::put($url, $effect);

        // HTTP call successful
        if ($response->successful()) {
            // [Debug]
            //print_r($response->json());

            return $response;
        // HTTP error
        } else {
            $msg = response()->json(['error'=> [
                'text' => 'HTTP request failed using hue lights rest api::setEffects()',
                'header' => $response->headers(),
                'status' => $response->status(),
                'body' => $response->body()
                ]
            ]);

            \Log::info($msg);
        }
    }
}
