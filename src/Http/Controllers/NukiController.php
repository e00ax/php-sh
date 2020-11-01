<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NukiController extends Controller
{
    protected $bridgeip;
    protected $token;
    protected $id;
    protected $port;
    protected $base_url;
    protected $user;
    protected $passwd;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->bridgeip = config('sh.nuki.bridgeIp');
        $this->token = config('sh.nuki.token');
        $this->id = config('sh.nuki.id');
        $this->port = config('sh.nuki.port');
        $this->user = config('sh.user');
        $this->passwd = config('sh.passwd');

        // Is bridgeip valid?
        if (filter_var($this->bridgeip, FILTER_VALIDATE_IP) == false) {
            $msg = "Bridge ip is not valid!";
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }
        
        // Base URL to use
        $this->base_url = "http://" . $this->bridgeip  . $this->port;
    }


    /**
     * Get bridgeip
     *
     * @return string Nuki bridge ip
     */
    public function getBridgeip()
    {
        return $this->bridgeip;
    }


    /**
     * Get token
     *
     * @return string Nuki developer token
     */
    public function getToken()
    {
        return $this->token;
    }


    /**
     * Get id
     *
     * @return int id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get port
     *
     * @return string Nuki bridge port
     */
    public function getPort()
    {
        return $this->port;
    }


    /**
     * Switch URL for different rest api calls
     *
     * @param string $type called from function
     * @param string $action Nuki lock action [lock|unlock|unlatch]
     * @return \Illuminate\Http\Response
     */
    public function setNuki($type, $action = '')
    {
        switch ($type) {
            case "getInfo":
                $url = $this->base_url . "/info?token=" . $this->token;
                $response = Http::withBasicAuth($this->user, $this->passwd)->get($url);
                break;
            
            case "getList":
                $url = $this->base_url . "/list?token=" . $this->token;
                $response = Http::withBasicAuth($this->user, $this->passwd)->get($url);
                break;

            case "getLockState":
                $url = $this->base_url . "/lockState?nukiId=" . $this->id . "&token=" . $this->token;
                $response = Http::withBasicAuth($this->user, $this->passwd)->get($url);
                break;

            case "setLockAction":
                $url = $this->base_url . "/lockAction?nukiId=" . $this->id . "&action=" . $action . "&token=" . $this->token;
                $response = Http::withBasicAuth($this->user, $this->passwd)->get($url);
                break;

            default:
                $msg = "Wrong type in NukiController::setNuki()";
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
     * Get buki lock info
     *
     * @return \Illuminate\Http\Response
     */
    public function getInfo()
    {
        return $this->setNuki(
            __FUNCTION__
        );
    }


    /**
     * Get list of nuki lock attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function getList()
    {
        return $this->setNuki(
            __FUNCTION__
        );
    }


    /**
     * Get nuki lock state
     *
     * @return \Illuminate\Http\Response
     */
    public function getLockState()
    {
        return $this->setNuki(
            __FUNCTION__
        );
    }


    /**
     * Set lock action
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setLockAction(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'action' => 'required'
        ]);

        return $this->setNuki(
            __FUNCTION__,
            config('sh.nuki.lockActions.' . $validatedData['action'])
        );

        // [Debug]
        //print_r($request->input());
    }
}
