<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HueLightsController extends HueController
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
    public function lights()
    {
        return view('hue.lights.lights');
    }


    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function search()
    {
        return view('hue.lights.search');
    }


    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function delete()
    {
        return view('hue.lights.delete');
    }


    /**
     * Get connected Hue lights as json
     *
     * @return \Illuminate\Http\Response
     */
    public function getLights()
    {
        return $this->setLights(
            __FUNCTION__
        );
    }


    /**
     * Set Hue lights with attributes
     *
     * @param string $type called from function
     * @param int $id
     * @param array $arg HTTP args
     * @return \Illuminate\Http\Response
     */
    public function setLights($type, $id = '', $arg = array())
    {
        switch ($type) {
            case "getLights":
                $url = $this->base_url . "/lights";
                $response = Http::get($url);
                break;
            
            case "quickSet":
            case "setLightState":
                $url = $this->base_url . "/lights/" . $id . "/state";
                $response = Http::put($url, $arg);
                break;

            case "searchLights":
                $url = $this->base_url . "/lights";
                $response = Http::asForm()->post($url);
                break;

            case "deleteLights":
                $url = $this->base_url . "/lights/" . $id;
                $response = Http::delete($url);
                break;

            case "renameLights":
                $url = $this->base_url . "/lights/" . $id;
                $response = Http::put($url, $arg);
                break;
            default:
                $msg = "Wrong type in HueLightsController::setLights()";
                \Log::info($msg);
                throw new \App\Exceptions\CustomException($msg);
                break;
        }

         // HTTP call successful
        if ($response->successful()) {
            // [Debug]
            //print_r($response->json());

            return $response;
        // HTTP error
        } else {
            $msg = response()->json(['error'=> [
                'text' => 'HTTP request failed using hue lights rest api::setLights()',
                'header' => $response->headers(),
                'status' => $response->status(),
                'status' => $response->body()
                ]
            ]);

            \Log::info($msg);
        }
    }


    /**
     * Search for new lights
     *
     * @return \Illuminate\Http\Response
     */
    public function searchLights()
    {
        return $this->setLights(
            __FUNCTION__
        );
    }


    /**
     * Delete light
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteLights(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'id' => 'required'
        ]);

        // Log everything
        //$input = $request->all();
        \Log::info($validatedData);
        
        // [Debug]
        print_r($request->input());

        return $this->setLights(
            __FUNCTION__,
            $validatedData['id']
        );
    }


    /**
     * Rename lights
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function renameLights(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        // Log everything
        //$input = $request->all();
        \Log::info($validatedData);

        $arg = array(
            "name" => $validatedData['name']
        );

        // [Debug]
        print_r($request->input());

        return $this->setLights(
            __FUNCTION__,
            $validatedData['id'],
            $arg
        );
    }


    /**
     * Quickset Hue lights
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function quickSet(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'id' => 'required',
            'state' => 'required'
        ]);

        //$input = $request->all();
        \Log::info($validatedData);
        
        // Hue args
        $arg = array(
            'on' => (bool) $validatedData['state']
        );

        // [Debug]
        print_r($request->input());

        return $this->setLights(
            __FUNCTION__,
            $validatedData['id'],
            $arg
        );
    }


    /**
     * Set Hue lights with attributes
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setLightState(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'colorPicker' => 'sometimes|max:7',
            'id' => 'required|max:2',
            'on' => 'sometimes',
            'bri' => 'sometimes|gte:1|lte:254',
            'hue' => 'sometimes|gte:0|lte:65535',
            'sat' => 'sometimes|gte:0|lte:254',
            //'X' => 'present|gte:0|lte:1',
            //'Y' => 'present|gte:0|lte:1',
            'ct' => 'sometimes|gte:153|lte:500',
            'alert' => 'sometimes',
            'effect' => 'sometimes',
            'transitiontime' => 'sometimes|gte:0|lte:50',
            'bri_inc' => 'sometimes|gte:-254|lte:254',
            'sat_inc' => 'sometimes|gte:-254|lte:254',
            'hue_inc' => 'sometimes|gte:-65534|lte:65534',
            'ct_inc' => 'sometimes|gte:-65534|lte:65534',
        ]);
        
        //$input = $request->all();
        \Log::info($request->input());

        // Remove values we don't need. Prevent errors
        if (isset($validatedData['colorPicker'])) {
            // Get RGB value from colorHex
            $rgb = $this->hex2rgb($validatedData['colorPicker']);

            // Get Hue XY value from RGB
            $xy = $this->rgb2xy(
                $rgb['red'],
                $rgb['green'],
                $rgb['blue']
            );

            unset($validatedData['colorPicker']);
            $validatedData['xy'] = $xy;
        }

        $id = $validatedData['id'];
        unset($validatedData['id']);

        /**
         * Cast data sice the bridge expects only true types
         */
        if (isset($validatedData['on'])) {
            $validatedData['on'] = true;
        }

        if (isset($validatedData['bri'])) {
            $validatedData['bri'] = (int) $validatedData['bri'];
        }

        if (isset($validatedData['sat'])) {
            $validatedData['sat'] = (int) $validatedData['sat'];
        }

        if (isset($validatedData['hue'])) {
            $validatedData['hue'] = (int) $validatedData['hue'];
        }

        if (isset($validatedData['ct'])) {
            $validatedData['ct'] = (int) $validatedData['ct'];
        }

        if (isset($validatedData['transitiontime'])) {
            $validatedData['transitiontime'] = (int) $validatedData['transitiontime'];
        }

        if (isset($validatedData['bri_inc'])) {
            $validatedData['bri_inc'] = (int) $validatedData['bri_inc'];
        }

        if (isset($validatedData['sat_inc'])) {
            $validatedData['sat_inc'] = (int) $validatedData['sat_inc'];
        }

        if (isset($validatedData['hue_inc'])) {
            $validatedData['hue_inc'] = (int) $validatedData['hue_inc'];
        }

        if (isset($validatedData['ct_inc'])) {
            $validatedData['ct_inc'] = (int) $validatedData['ct_inc'];
        }

        // [Debug]
        print_r($request->input());
        
        return $this->setLights(
            __FUNCTION__,
            $id,
            $validatedData
        );
    }
}
