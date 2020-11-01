<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Ws2801Controller extends HueController
{
    protected $baseUrl;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->baseUrl = config('sh.ws2801.baseUrl');
    }


    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index(Request $request)
    {
        //...
    }


    /**
     * Get baseUrl
     *
     * @return string base URL
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setWs2801(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'colorHex' => 'required|max:7',
            'id' => 'required',
        ]);

        // Log data
        \Log::info($validatedData);

        $rgbArray = $this->hex2rgb($validatedData['colorHex']);
        
        // Make cross domain HTTP post
        $url = $this->baseUrl . 'ws2801.post.php';
        $response = Http::asForm()->post($url, $rgbArray);
        
        // HTTP call successful
        if ($response->successful()) {
            // [Debug]
            //print_r($response->json());

            return $response;
        // HTTP error
        } else {
            $msg = response()->json(['error'=> [
                'text' => 'HTTP request failed on ws2801 lightstripes!',
                'header' => $response->headers(),
                'status' => $response->status(),
                'status' => $response->body()
                ]
            ]);

            \Log::info($msg);
        }
    }
}
