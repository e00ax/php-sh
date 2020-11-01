<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HueController extends Controller
{
    protected $key;
    protected $bridgeip;
    protected $base_url;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->key = config('sh.hue.userkey');
        $this->bridgeip = config('sh.hue.bridgeip');

        // Is bridgeip valid?
        if (filter_var($this->bridgeip, FILTER_VALIDATE_IP) == false) {
            $msg = "Bridge ip is not valid!";
            \Log::info($msg);
            throw new \App\Exceptions\CustomException($msg);
        }
        
        // Base URL to use
        $this->base_url = "http://" . $this->bridgeip . "/api/" . $this->key;
    }


    /**
     * Get key
     *
     * @return string hue bridge user key
     */
    public function getKey()
    {
        return $this->key;
    }


    /**
     * Get bridgeip
     *
     * @return string hue bridge ip
     */
    public function getBridgeip()
    {
        return $this->bridgeip;
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
     * Convert color values from hex to RGB
     *
     * @param string $hexStr hex values
     * @param bool $returnAsString
     * @param string $seperator concat seperator
     * @return string|array RGB array
     */
    public function hex2rgb($hexStr, $returnAsString = false, $seperator = ',')
    {
        // Gets a proper hex string
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);

        $rgbArray = array();

        //If a proper hex code, convert using bitwise operation. No overhead... faster
        if (strlen($hexStr) == 6) {
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;

            //if shorthand notation, need some string manipulations
        } elseif (strlen($hexStr) == 3) {
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } else {
            //Invalid hex color code
            return false;
        }

        // returns the rgb string or the associative array
        return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
    }


    /**
     * Convert color values from RGB to Hue XY
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return array XY array
     */
    public function rgb2xy($red, $green, $blue)
    {
        // [debug]
        //$red = 255;
        //$green = 255;
        //$blue = 255;
        //echo "red: ".$red."<br>"."green: ".$green."<br>"."blue: ".$blue."<br><br>";

        // Normalize the values to 1
        $normalizedToOne['red'] = $red / 255;
        $normalizedToOne['green'] = $green / 255;
        $normalizedToOne['blue'] = $blue / 255;

        // Make colors more vivid
        foreach ($normalizedToOne as $key => $normalized) {
            if ($normalized > 0.04045) {
                $color[$key] = pow(($normalized + 0.055) / (1.0 + 0.055), 2.4);
            } else {
                $color[$key] = $normalized / 12.92;
            }
        }

        // Convert to XYZ using the Wide RGB D65 formula
        $xyz['x'] = $color['red'] * 0.664511 + $color['green'] * 0.154324 + $color['blue'] * 0.162028;
        $xyz['y'] = $color['red'] * 0.283881 + $color['green'] * 0.668433 + $color['blue'] * 0.047685;
        $xyz['z'] = $color['red'] * 0.000000 + $color['green'] * 0.072310 + $color['blue'] * 0.986039;

        // Calculate the x/y values
        if (array_sum($xyz) == 0) {
            $x = 0;
            $y = 0;
        } else {
            $x = $xyz['x'] / array_sum($xyz);
            $y = $xyz['y'] / array_sum($xyz);
        }

        return array(
            '0'   => $x,
            '1'   => $y
            //'bri' => round($xyz['y'] * 255)
        );
    }
}
