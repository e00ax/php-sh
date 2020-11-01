<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HueSensorsController extends HueController
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
    public function sensors()
    {
        return view('hue.sensors.sensors');
    }


    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function search()
    {
        return view('hue.sensors.search');
    }


    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function delete()
    {
        return view('hue.sensors.delete');
    }


    /**
     * Get connected Hue sensors as json
     *
     * @return \Illuminate\Http\Response
     */
    public function getSensors()
    {
        return $this->setSensors(
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
    public function setSensors($type, $id = '', $arg = array())
    {
        switch ($type) {
            case "getSensors":
                $url = $this->base_url . "/sensors";
                $response = Http::get($url);
                break;

            case "searchSensors":
                $url = $this->base_url . "/sensors";
                $response = Http::asForm()->post($url);
                break;

            case "deleteSensors":
                $url = $this->base_url . "/sensors/" . $id;
                $response = Http::delete($url);
                break;

            case "renameSensors":
                $url = $this->base_url . "/sensors/" . $id;
                $response = Http::put($url, $arg);
                break;
            default:
                $msg = "Wrong type in HueSensorsController::setSensors()";
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
     * Search for new sensors
     *
     * @return \Illuminate\Http\Response
     */
    public function searchSensors()
    {
        return $this->setSensors(
            __FUNCTION__
        );
    }


    /**
     * Delete sensors
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSensors(Request $request)
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

        return $this->setSensors(
            __FUNCTION__,
            $validatedData['id']
        );
    }


    /**
     * Rename sensors
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function renameSensors(Request $request)
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

        return $this->setSensors(
            __FUNCTION__,
            $validatedData['id'],
            $arg
        );
    }
}
