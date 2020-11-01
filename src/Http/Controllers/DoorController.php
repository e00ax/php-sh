<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NukiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DoorController extends Controller
{
    protected $baseUrl;
    protected $user;
    protected $passwd;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct(NukiController $NukiController)
    {
        $this->nukiLock = $NukiController;
        $this->baseUrl = config('sh.door.baseUrl');
        $this->user = config('sh.user');
        $this->passwd = config('sh.passwd');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function index()
    {
        return view('door.door', [
            'frontDoorBellState' => $this->getBellState(),
            'nukiInfo' => json_decode($this->nukiLock->getInfo(), true),
            'nukiList' => json_decode($this->nukiLock->getList(), true)
        ]);
    }


    /**
     * Get baseUrl
     *
     * @return string Doorpi base URL
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }


    /**
     * HTTP request helper
     *
     * @param string $type called from function
     * @param array $arg HTTP args
     * @return \Illuminate\Http\Response
     */
    public function requestState($type, $arg = array())
    {
        switch ($type) {
            case "getBellState":
                $url = $this->baseUrl . 'frontDoorBell.get.php';
                $response = Http::withBasicAuth($this->user, $this->passwd)->asForm()->post($url, $arg);
                break;

            case "setBellState":
                $url = $this->baseUrl . 'frontDoorBell.post.php';
                $response = Http::withBasicAuth($this->user, $this->passwd)->asForm()->post($url, $arg);
                break;

            case "setDoorState":
                $url = $this->baseUrl . 'frontDoor.post.php';
                $response = Http::withBasicAuth($this->user, $this->passwd)->asForm()->post($url, $arg);
                break;

            default:
                $msg = "Wrong type in DoorController::requestState()";
                \Log::info($msg);
                throw new \App\Exceptions\CustomException($msg);
                break;
        }

        // HTTP call successful
        if ($response->successful()) {
            // [Debug]
            //print_r($response->json());

            return $response->body();
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
     * Get door bell state
     *
     * @return \Illuminate\Http\Response
     */
    public function getBellState()
    {
        $data = array(
            'pin' => config('sh.door.channel.frontDoorBell'),
            'gpio' => config('sh.door.gpio')
        );

        // Log everything
        \Log::info($data);

        return $this->requestState(
            __FUNCTION__,
            $data
        );
    }


    /**
     * Set door bell state
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setBellState(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'state' => 'required'
        ]);

        // Log everything
        \Log::info($validatedData);

        $data = array(
            'state' => $validatedData['state'],
            'pin' => config('sh.door.channel.frontDoorBell'),
            'gpio' => config('sh.door.gpio')
        );

        // [Debug]
        //print_r($request->input());

        return $this->requestState(
            __FUNCTION__,
            $data
        );
    }


    /**
     * Set front door state
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setDoorState(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'state' => 'required'
        ]);

        // Log everything
        \Log::info($validatedData);

        $data = array(
            'state' => $validatedData['state'],
            'pin' => config('sh.door.channel.frontDoor')
        );

        // [Debug]
        //print_r($request->input());

        return $this->requestState(
            __FUNCTION__,
            $data
        );
    }
}
