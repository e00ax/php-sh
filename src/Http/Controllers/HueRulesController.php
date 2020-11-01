<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HueRulesController extends HueController
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
    public function rules()
    {
        return view('hue.rules.rules');
    }


    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function create()
    {
        return view('hue.rules.create');
    }


    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function delete()
    {
        return view('hue.rules.delete');
    }


    /**
     * Get Hue rules as json
     *
     * @return \Illuminate\Http\Response
     */
    public function getRules()
    {
        return $this->setRules(
            __FUNCTION__
        );
    }


    /**
     * Set Hue rules with attributes
     *
     * @param string $type called from function
     * @param int $id
     * @param array $arg HTTP args
     * @return \Illuminate\Http\Response
     */
    public function setRules($type, $id = '', $arg = array())
    {
        switch ($type) {
            case "getRules":
                $url = $this->base_url . "/rules";
                $response = Http::get($url);
                break;

            case "createRules":
                $url = $this->base_url . "/rules";
                $response = Http::post($url, $arg);
                break;

            case "deleteRules":
                $url = $this->base_url . "/rules/" . $id;
                $response = Http::delete($url);
                break;

            case "updateRules":
                $url = $this->base_url . "/rules/" . $id;
                $response = Http::put($url, $arg);
                break;
            default:
                $msg = "Wrong type in HueRulesController::setRules()";
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
                'text' => 'HTTP request failed using hue lights rest api::setRules()',
                'header' => $response->headers(),
                'status' => $response->status(),
                'status' => $response->body()
                ]
            ]);

            \Log::info($msg);
        }
    }


    /**
     * Create rules
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function createRules(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'name' => 'required',
            'button' => 'required|integer',
            'targetGroup' => 'required|integer',
            'targetSensor' => 'required|integer',
            'condition' => 'required',
            'action' => 'required',
            'scene' => 'sometimes'
        ]);

        // Log everything
        //$input = $request->all();
        \Log::info($validatedData);

        $arg = array();

        /**
         * Set rules attributes
         */
        $arg['name'] = $validatedData['name'];

        // Set buttonevent
        $arg['conditions'][0]['address'] = "/sensors/" . $validatedData['targetSensor'] . "/state/buttonevent";
        $arg['conditions'][0]['operator'] = "eq";
        $arg['conditions'][0]['value'] = $validatedData['button'];

        // Check if lastupdated has changed (dx)
        $arg['conditions'][1]['address'] = "/sensors/" . $validatedData['targetSensor'] . "/state/lastupdated";
        $arg['conditions'][1]['operator'] = "dx";

        // Set group condition
        $arg['conditions'][2]['address'] = "/groups/" . $validatedData['targetGroup'] . "/state/any_on";
        $arg['conditions'][2]['operator'] = "eq";
        // No extra group validation needed because we can send the value as string!
        $arg['conditions'][2]['value'] = $validatedData['condition'];

        // Set actions
        $arg['actions'][0]['address'] = "/groups/" . $validatedData['targetGroup'] . "/action";
        $arg['actions'][0]['method'] = "PUT";

        // Validate actions because we need true bool values or a scene
        if ($validatedData['action'] == 'ON') {
            $arg['actions'][0]['body']['on'] = true;
        } elseif ($validatedData['action'] == 'OFF') {
            $arg['actions'][0]['body']['on'] = false;
        } else {
            $arg['actions'][0]['body'] = config('scenes.' . $validatedData['scene']);
        }
        
        return $this->setRules(
            __FUNCTION__,
            '',
            $arg,
        );

        // [Debug]
        //print_r($request->input());
    }


    /**
     * Select rules
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function selectRules(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'name' => 'required'
        ]);
        
        return response()->view('hue.rules.' . $validatedData['name'] . "Layout", ['name' => $validatedData['name']]);

        // [Debug]
        //print_r($request->input());
    }


    /**
     * Delete rules
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteRules(Request $request)
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
            
        return $this->setRules(
            __FUNCTION__,
            $validatedData['id']
        );
    }


    /**
     * Update rules
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateRules(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'name' => 'required',
            'rules' => 'required|array'
        ]);

        // Log everything
        //$input = $request->all();
        \Log::info($validatedData);

        $arg = array(
            "name" => $validatedData['name'],
            "rules" => $validatedData['rules']
        );
        
        // [Debug]
        print_r($request->input());

        return $this->setRules(
            __FUNCTION__,
            $validatedData['id'],
            $arg
        );
    }
}
