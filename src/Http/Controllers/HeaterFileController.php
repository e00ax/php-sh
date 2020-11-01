<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HeaterFileController extends Controller
{
    protected $iniPath;
    protected $iniFile;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->iniPath = config('sh.heater.ini');

        // Check for ini file
        if (!file_exists($this->iniPath)) {
            $msg = sprintf("File `%s` not found!", $this->iniPath);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        
        // Check for w status
        } elseif (!is_writeable($this->iniPath)) {
            $msg = sprintf("Cannot open `%s` for writing!", $this->iniPath);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);

        // Parse heater.ini
        } else {
            $this->iniFile = parse_ini_file($this->iniPath, true);
        }
    }


    /**
     * Get iniPath
     *
     * @return string Ini path
     */
    public function getIniPath()
    {
        return $this->iniPath;
    }


    /**
     * Get Ini file
     *
     * @return string Ini file
     */
    public function getIniFile()
    {
        return $this->iniFile;
    }


    /**
     * Write target Temperature to heater.ini
     *
     * @param string $mode heater mode [manual|auto|google]
     * @param string $temp themperature
     * @return exit code
     */
    public function writeIniMode($mode, $temp = '')
    {
        // Open file for reading
        if (!$fp = fopen($this->iniPath, 'r')) {
            $msg = sprintf("Cannot open `%s` for reading!", $this->iniPath);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }
        
        $data = array();
        while (!feof($fp)) {
            $line = fgets($fp);
            
            // Only replace line if temp is available
            if ($temp !== '') {
                // Replace day temp
                if (preg_match('/temp=/', $line)) {
                    $line = "temp=" . $temp . "\n";
                }
            }
             
            // Replace mode
            if (preg_match('/mode=/', $line)) {
                $line = "mode=" . $mode . "\n";
            }
                
            $data[] = $line;
        }
            
        fclose($fp);
            
        // Try to write data to heater.ini
        if (file_put_contents($this->iniPath, $data) === false) {
            $msg = sprintf("Unable to write to: `%s`", $this->iniPath);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }

        return sprintf("Sucess writing mode [%s] to:\n`%s`", $mode, $this->iniPath);
    }


    /**
     * Write automatic cycles to heater.ini
     *
     * @param array $data data from auto heater cycles form
     * @return string formatted output
     */
    public function writeIniAuto($data)
    {
        // Header
        $line = ";============================================================================\n";
        $line .= ";Name        : heater.ini\n";
        $line .= ";Author      : Christian Rickert\n";
        $line .= ";Version     : 0.1\n";
        $line .= ";Description : Ini file for smarthome heater cycles\n";
        $line .= ";============================================================================\n";
        $line .= "[auto]\n";

        // Get days as assoc array
        for ($i = 0; $i < 7; $i++) {
            $days[($i+1)] = jddayofweek($i, 2);
        }

        $del = '';

        // Loop over weekdays from config.inc.php
        foreach ($days as $daynum => $dayname) {
            // Dayname first
            $line .= $dayname . "=";

            // Loop over $_POST values
            foreach ($data as $key => $val) {

                $form_daynum = substr($key, -2, 1);
                $form_fieldnum = substr($key, -1, 1);
                $form_postfix = $form_daynum . $form_fieldnum;

                // Get data per day
                if ($form_daynum == $daynum) {
                    if ($key == ('startHours' . $form_postfix)) {
                        $del = ':';
                    }
                    
                    if ($key == ('startMinutes' . $form_postfix)) {
                        $del = '-';
                    }

                    if ($key == ('endHours' . $form_postfix)) {
                        $del = ':';
                    }
                    
                    if ($key == ('endMinutes' . $form_postfix)) {
                        $del = '-';
                    }

                    if ($key == ('temp' . $form_postfix)) {
                        $del = '#';
                    }

                    // Weekday line in heater.ini
                    $line .= $val . $del;
                }
            }
            // Cut off the ugly '#' at the end of every line
            $line = substr($line, 0, -1);
            $line .= "\n";
        }

        // Set manual data
        $line .= "\n[manual]\ntemp=" . $data['manual'];

        // Set control to auto
        $line .= "\n\n[control]\nmode=auto";

        // Open for writing
        if (!$fp = fopen($this->iniPath, 'w')) {
            $msg = sprintf("Cannot open `%s` for writing!", $this->iniPath);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }

        // Try to write
        if (fwrite($fp, $line) === false) {
            $msg = sprintf("Unable to write to: `%s`", $this->iniPath);
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }

        fclose($fp);

        return sprintf("Sucess writing mode [auto] to:\n`%s`", $this->iniPath);
    }
}
