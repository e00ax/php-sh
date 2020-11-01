<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Volantus\Pigpio\Client;
use Volantus\Pigpio\Protocol\Commands;
use Volantus\Pigpio\Protocol\DefaultRequest;
use Volantus\Pigpio\Protocol\DefaultResponseStructure;

class HeaterController extends HeaterFileController
{
    protected $gpio;
    protected $pin;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->gpio = config('sh.heater.gpio');
        $this->pin = config('sh.heater.channel.1');
    }


    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function cycles()
    {
        return view('heater.cycles', ['iniFile' => $this->iniFile]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return view
     */
    public function mode()
    {
        return view('heater.mode');
    }


    /**
     * Get gpio
     *
     * @return int gpio
     */
    public function getGpio()
    {
        return $this->gpio;
    }


    /**
     * Get pin
     *
     * @return int pin
     */
    public function getPin()
    {
        return $this->pin;
    }
    

    /**
     * Set heater mode
     *
     * @param \Illuminate\Http\Request  $request
     * @return string formatted output
     */
    public function setMode(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'mode' => 'required|string'
        ]);

        // Log everything
        //$input = $request->all();
        \Log::info($validatedData);

        return $this->writeIniMode($validatedData['mode']);
        
        // [Debug]
        //print_r($request->input());
    }


    /**
     * Get gpio state
     *
     * @return int gpio output
     */
    public function getStateExec()
    {
        // Gpio command
        $cmd = sprintf(
            "%s -g read %s",
            $this->gpio,
            $this->pin
        );

        if (!file_exists($this->gpio)) {
            $msg = sprintf("File `%s` not found!", $this->gpio);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }

        // GPIO cmd
        exec($cmd, $out, $retval);

        // Error handling
        if ($retval == 0) {
            return $out[0];
        } else {
            $msg = sprintf("Gpio command execution failed!Retval: `%s`", $retval);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }
    }


    /**
     * Set gpio state using gpio system call
     *
     * @param int $state gpio state
     * @return string gpio output
     */
    public function setStateExec($state)
    {
        // Gpio mode
        $cmd_mode = sprintf(
            "%s -g mode %s out",
            $this->gpio,
            $this->pin
        );

        // Gpio command
        $cmd = sprintf(
            "%s -g write %s %s",
            $this->gpio,
            $this->pin,
            $state
        );

        if (!file_exists($this->gpio)) {
            $msg = sprintf("File `%s` not found!", $this->gpio);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }

        // GPIO cmd
        exec($cmd_mode);
        exec($cmd, $out, $retval);

        // Error handling
        if ($retval == 0) {
            return $retval;
        } else {
            $msg = sprintf("Gpio command execution failed!Retval: `%s`", $retval);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }
    }


    /**
     * Get gpio state with pigpiod
     *
     * @return \Volantus\Response
     */
    public function getStatePigpio()
    {
        // Change pin state using pigpiod
        $client = new Client();
        $responseStructure = new DefaultResponseStructure();
        $response = $client->sendRaw(new DefaultRequest(
            Commands::READ,
            $this->pin,
            0,
            $responseStructure
        ));

        // was successful
        if ($response->isSuccessful() == 0) {
            $msg = sprintf("Unable to get heater state.Pigpio error: `%s`", $response->getResponse());
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        } else {
            // some responses return data (P3)
            return $response->getResponse();
        }
    }


    /**
     * Set gpio state with pigpiod
     *
     * @param int $state pigpio state
     * @return \Volantus\Response
     */
    public function setStatePigpio($state)
    {
        // Change pin state using pigpiod
        $client = new Client();
        $responseStructure = new DefaultResponseStructure();
        $response = $client->sendRaw(new DefaultRequest(
            Commands::WRITE,
            $this->pin,
            $state,
            $responseStructure
        ));

        // was successful
        if ($response->isSuccessful() == 0) {
            $msg = sprintf("Unable to set heater state.Pigpio error: `%s`", $response->getResponse());
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        } else {
            // some responses return data (P3)
            return $response->getResponse();
        }
    }


    /**
     * Quickset Heater
     *
     * @param \Illuminate\Http\Request $request
     * @return string formatted output
     */
    public function quickSet(Request $request)
    {
        // Validate data first
        $validatedData = $request->validate([
            'heaterState' => 'required|max:1',
            'heaterTemp' => 'required|max:2',
            'currentTemp' => 'required',
        ]);

        // Log everything
        //$input = $request->all();
        \Log::info($validatedData);

        if ($validatedData['heaterTemp'] < $validatedData['currentTemp']) {
            return sprintf(
                "Nothing to do...\nCurrent temperature [%d°C] is higher than set temperature [%d°C]",
                $validatedData['currentTemp'],
                $validatedData['heaterTemp']
            );
        } else {
            $writeIniMode = $this->writeIniMode(
                'manual',
                $validatedData['heaterTemp']
            );
    
            $setStatePigpio = $this->setStatePigpio($validatedData['heaterState']);
    
            return sprintf(
                "%s\nsetStatePigpio response: %s",
                $writeIniMode,
                $setStatePigpio
            );
            
            // [Debug]
            //print_r($validatedData);
        }
    }


    /**
     * Set heater cycles
     *
     * @param \Illuminate\Http\Request $request
     * @return string formatted output
     */
    public function setCycles(Request $request)
    {
        // Log everything
        \Log::info($request->input());

        return $this->writeIniAuto($request->input());

        // [Debug]
        #print_r($request->input());
    }
}
