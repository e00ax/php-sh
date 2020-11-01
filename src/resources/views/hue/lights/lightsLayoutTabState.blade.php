<form action="{{ route('hueLightsSetState.post') }}" method="post" id="setLightState{{ $i }}" name="setLightState">
    <div>
        <table class="hover foundation">
            <thead style="background: #e1e1e1;">
                <tr>
                    <th width="20%">Option</th>
                    <th width="80%">Value</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop over callable state attributes first 
                @php
                    HueHelper::showLightState($lights[$i]['state'], $i);
                @endphp
                -->
                @php
                    if ($lights[$i]['state']['on'] == true) {
                        $checked = "checked";
                        //$img = "on";
                    }else {
                        $checked = "";
                        //$img = "off";
                    }
                @endphp

                <!-- on|off -->
                <tr>
                    <td>on</td>
                    <td>
                        <!--<input type="text" id="on{{ $i }}" name="on" value="{{ $lights[$i]['state']['on'] }}">-->
                        <div class="contbox subtext" style="padding-top:10px;text-align: left">
                            <div class="switch radius">
                                <input id="on{{ $i }}" class="switch-input" type="checkbox" name="on" {{ $checked }}>
                                <label class="switch-paddle" for="on{{ $i }}">
                                    <span class="show-for-sr">Light Control</span>
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- bri -->
                <tr>
                    <td>bri</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 80%;border:0px solid #000000;padding: 12px 10px 0 10px;">
                                <div id="briSlider{{ $i }}" name="lightStateSlider" class="slider" data-slider data-step="1" data-initial-start="{{ $lights[$i]['state']['bri'] }}" data-options="{{ config('sh.hue.slider.bri') }}precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="bri{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 20%;border:0px solid #000000;padding: 26px 0 0 10px;">
                                <input type="text" id="bri{{ $i }}" name="bri" value="{{ $lights[$i]['state']['bri'] }}" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- only for colored lights from here! -->
                @if (isset($lights[$i]['state']['colormode']))
                <!-- Color Picker -->
                <tr>
                    <td>Color</td>
                    <td>
                        <div style="padding: 18px 0 0 0;border: 0px solid #000;">
                            <input type="color" id="colorPicker{{ $i }}" name="colorPicker" value="#ff0000" style="background: #f8f9fa;border: none;">
                        </div>
                    </td>
                </tr>

                <!-- sat -->
                <tr>
                    <td>sat</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 80%;border:0px solid #000000;padding: 12px 10px 0 10px;">
                                <div id="satSlider{{ $i }}" name="lightStateSlider" class="slider" data-slider data-step="1" data-initial-start="{{ $lights[$i]['state']['sat'] }}" data-options="{{ config('sh.hue.slider.sat') }}precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="sat{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 20%;border:0px solid #000000;padding: 26px 0 0 10px;">
                                <input type="text" id="sat{{ $i }}" name="sat" value="{{ $lights[$i]['state']['sat'] }}" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- effect -->
                <tr>
                    <td>effect</td>
                    <td>
                        <!--<input type="text" id="effect{{ $i }}" name="effect" value="{{ $lights[$i]['state']['effect'] }}">-->
                        <select class="foundation" id="effect{{ $i }}" name="effect">
                            <option value="none">none</option>
                            <option value="colorloop">colorloop</option>
                        </select>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Hidden stuff -->
    <input type="hidden" id="id{{ $i }}" name="id" value="{{ $i }}">

    <!-- Submit -->
    <div style="padding:15px 0 0 0;">
        <div style="width:50%;text-align:left;">
            <button type="submit" class="button" id="submit{{ $i }}" name="submit" style="width: 100px;">{{ trans('messages.submit') }}</button>
        </div>
    </div>
</form>