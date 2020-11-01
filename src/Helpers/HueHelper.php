<?php

namespace App\Helpers;

class HueHelper
{
    public static $sliders = array(
        'bri',
        'hue',
        'sat',
        'ct'
    );

    public static $fields = array(
        'on',
        'effect',
        'alert',
    );


    /**
     * Loop over Hue group state and display sliders
     *
     * @param array $lightState hue goup state
     * @param int $id id
     * @return string HTML output
     */
    public static function showLightState($lightState, $id)
    {
        foreach ($lightState as $key => $val) {
            $str = '';
            /*
            // XY array
            if ($key == 'xy') {
                // X
                $str = "<tr>";
                    $str .= "<td class='headlineTable'>X</td>";
                    $str .= "<td style='padding: 15px 10px 0 10px;'>";
                        $str .= "<input type='text' id=\"".$key.$id."_X\" name='X' value=\"".$val[0]."\" style='height: 40px;'>";
                    $str .= "</td>";
                $str .= "</tr>";

                // Y
                $str .= "<tr>";
                    $str .= "<td class='headlineTable'>Y</td>";
                    $str .= "<td style='padding: 15px 10px 0 10px;'>";
                        $str .= "<input type='text' id=\"".$key.$id."_Y\" name='Y' value=\"".$val[1]."\" style='height: 40px;'>";
                    $str .= "</td>";
                $str .= "</tr>";
            }
            */
            // Text fields
            if (in_array($key, self::$fields)) {
                $str = "<tr>";
                    $str .= "<td class='headlineTable'>" . $key . "</td>";
                    $str .= "<td style='padding: 15px 10px 0 10px;'>";
                        $str .= "<input type='text' id=\"".$key.$id."\" name=\"".$key."\" value=\"".$val."\" style='height: 40px;'>";
                    $str .= "</td>";
                $str .= "</tr>";
            }

            // Sliders
            if (in_array($key, self::$sliders)) {
                $str = "<tr>";
                $str .= "<td class='headlineTable'>$key</td>";
                    $str .= "<td>";
                        $str .= "<div class='rowbox'>";
                            $str .= "<div style='width: 80%;border:0px solid #000000;padding: 12px 10px 0 10px;'>";
                                $str .= "<div id=\"".$key.$id."Slider\" name=\"".$key."Slider\" class='slider' data-slider data-step='1' data-initial-start=\"" . $val . "\" data-options=\"" . config("sh.hue.slider.$key") . "\"precision:null;\">";
                                    $str .= "<span class='slider-handle' data-slider-handle role='slider' tabindex='1' aria-controls=\"".$key.$id."\"></span>";
                                    $str .= "<span class='slider-fill' data-slider-fill></span>";
                                $str .= "</div>";
                            $str .= "</div>";
                            $str .= "<div style='width: 20%;border:0px solid #000000;padding: 26px 0 0 10px;'>";
                                $str .= "<input type='text' id=\"".$key.$id."\" name=\"".$key."\" value=\"" . $val . "\" style='background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;'>";
                            $str .= "</div>";
                        $str .= "</div>";
                    $str .= "</td>";
                $str .= "</tr>";
            }

            //print_r($val);

            echo $str;
        }
    }


    /**
     * Helper function to show fields
     *
     * @param string $item item
     * @param string $key key
     * @return string HTML output
     */
    public static function showFields($item, $key)
    {
        $str = '';

        $str = "<tr>";
            $str .= "<td class=\"headlineTable\">$key</td>";
            $str .= "<td>$item</td>";
        $str .= "</tr>";

        echo $str;
    }


    /**
     * Display Info array recursive
     *
     * @param array $a Info array
     * @param string $var concat string
     * @param int $i depth
     * @return string HTML output
     */
    public static function recurseInfo($a, $var = '', $i = 0)
    {
        $string = "";

        if (!is_array($a)) {
            $var .= $a;
            return $var;
        }
        
        // Recurse over info array
        foreach ($a as $k => $value) {
            if (is_array($value)) {
                $string .= "<tr><td class=\"headlineTable\" colspan=\"2\">[$k]</td></tr>";
                $string .= HueHelper::recurseInfo($value, $var, $i + 1);
            } else {
                $string .= "<tr><td>$k</td><td>$value</td></tr>";
            }
        }

        return $string;
    }
}
