<form action="{{ route('hueLightsSetState.post') }}" method="post" id="setGroupEffect{{ $i }}" name="setGroupState">
    <div>
        <table class="hover foundation">
            <thead style="background: #e1e1e1;">
                <tr>
                    <th width="20%">Option</th>
                    <th width="80%">Value</th>
                </tr>
            </thead>
            <tbody>
                @php
                    if ($groups[$i]['action']['on'] == true) {
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

                <!-- transitiontime -->
                <tr>
                    <td>transitiontime</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 80%;border:0px solid #000000;padding: 12px 10px 0 10px;">
                                <div id="transitiontimeSlider{{ $i }}" name="groupStateSlider" class="slider" data-slider data-step="1" data-initial-start="0" data-options="start: 0; end: 50;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="transitiontime{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 20%;border:0px solid #000000;padding: 26px 0 0 10px;">
                                <input type="text" id="transitiontime{{ $i }}" name="transitiontime" value="0" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- bri_inc -->
                <tr>
                    <td>bri_inc</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 80%;border:0px solid #000000;padding: 12px 10px 0 10px;">
                                <div id="bri_incSlider{{ $i }}" name="groupStateSlider" class="slider" data-slider data-step="1" data-initial-start="0" data-options="{{ config('sh.hue.slider.bri_inc') }}precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="bri_inc{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 20%;border:0px solid #000000;padding: 26px 0 0 10px;">
                                <input type="text" id="bri_inc{{ $i }}" name="bri_inc" value="0" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- sat_inc -->
                <tr>
                    <td>sat_inc</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 80%;border:0px solid #000000;padding: 12px 10px 0 10px;">
                                <div id="sat_incSlider{{ $i }}" name="groupStateSlider" class="slider" data-slider data-step="1" data-initial-start="0" data-options="{{ config('sh.hue.slider.sat_inc') }}precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="sat_inc{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 20%;border:0px solid #000000;padding: 26px 0 0 10px;">
                                <input type="text" id="sat_inc{{ $i }}" name="sat_inc" value="0" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- ct_inc -->
                <tr>
                    <td>ct_inc</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 80%;border:0px solid #000000;padding: 12px 10px 0 10px;">
                                <div id="ct_incSlider{{ $i }}" name="groupStateSlider" class="slider" data-slider data-step="1" data-initial-start="0" data-options="{{ config('sh.hue.slider.ct_inc') }}precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="ct_inc{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 20%;border:0px solid #000000;padding: 26px 0 0 10px;">
                                <input type="text" id="ct_inc{{ $i }}" name="ct_inc" value="0" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>
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