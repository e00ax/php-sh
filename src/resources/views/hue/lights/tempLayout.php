<form action="{{ route('hueLightsSetState.post') }}" class="hue" method="post" id="hueLightsState{{ $i }}" name="hueLightsState">
    <div>
        <table class="hover foundation">
            <thead style="background: #e1e1e1;">
                <tr>
                    <th width="50%">Option</th>
                    <th width="50%">Value</th>
                </tr>
            </thead>
            <tbody>
                <!-- Color Picker -->
                <tr>
                    <td>Color</td>
                    <td>
                        <div style="padding: 18px 50px 0 50px;border: 0px solid #000;">
                            <input type="color" id="hueLightsColorPicker{{ $i }}" name="hueLightsColorPicker" value="#ff0000" style="background: #f8f9fa;border: none;">
                        </div>
                    </td>
                </tr>

                <!-- Brightness -->
                <tr>
                    <td>bri</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 60%;border:0px solid #000000;padding: 12px 50px 0 50px;">
                                <div id="hueLightsBriSlider{{ $i }}" name="hueLightsBriSlider" class="slider" data-slider data-step="1" data-initial-start="{{ $lights[$i]['state']['bri'] }}" data-options="start: 1; end: 254;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="hueLightsBri{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 40%;border:0px solid #000000;padding: 26px 0 0 100px;">
                                <input type="text" id="hueLightsBri{{ $i }}" name="hueLightsBri" value="{{ $lights[$i]['state']['bri'] }}" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Saturation -->
                <tr>
                    <td>sat</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 60%;border:0px solid #000000;padding: 12px 50px 0 50px;">
                                <div id="hueLightsSatSlider{{ $i }}" name="hueLightsSatSlider" class="slider" data-slider data-step="1" data-initial-start="{{ $lights[$i]['state']['sat'] }}" data-options="start: 0; end: 254;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="hueLightsSat{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 40%;border:0px solid #000000;padding: 26px 0 0 100px;">
                                <input type="text" id="hueLightsSat{{ $i }}" name="hueLightsSat" value="{{ $lights[$i]['state']['sat'] }}" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Hue 
                <tr>
                    <td>hue</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 60%;border:0px solid #000000;padding: 12px 50px 0 50px;">
                                <div id="hueSlider{{ $i }}" name="hueSlider" class="slider" data-slider data-step="1" data-initial-start="{{ $lights[$i]['state']['hue'] }}" data-options="start: 0; end: 65535;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="hue{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 40%;border:0px solid #000000;padding: 26px 0 0 100px;">
                                <input type="text" id="hue{{ $i }}" name="hue" value="{{ $lights[$i]['state']['hue'] }}" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>-->

                <!-- CT 
                <tr>
                    <td>ct</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 60%;border:0px solid #000000;padding: 12px 50px 0 50px;">
                                <div id="ctSlider{{ $i }}" name="ctSlider" class="slider" data-slider data-step="1" data-initial-start="{{ $lights[$i]['state']['ct'] }}" data-options="start: 153; end: 500;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="ct{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 40%;border:0px solid #000000;padding: 26px 0 0 100px;">
                                <input type="text" id="ct{{ $i }}" name="ct" value="{{ $lights[$i]['state']['ct'] }}" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>-->

                <!-- Effect 
                <tr>
                    <td>effect</td>
                    <td><input type="text" id="hueLightsEffect{{ $i }}" name="hueLightsEffect" style="width: 250px;" value="{{ $lights[$i]['state']['effect'] }}"></td>
                </tr>-->

                <!-- Alert 
                <tr>
                    <td>alert</td>
                    <td><input type="text" id="hueLightsAlert{{ $i }}" name="hueLightsAlert" style="width: 250px;" value="{{ $lights[$i]['state']['alert'] }}"></td>
                </tr>-->

                <!-- Transitiontime -->
                <tr>
                    <td>transitiontime</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 60%;border:0px solid #000000;padding: 12px 50px 0 50px;">
                                <div id="hueLightsTransitiontimeSlider{{ $i }}" name="hueLightsTransitiontimeSlider" class="slider" data-slider data-step="1" data-initial-start="0" data-options="start: 0; end: 100;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="hueLightsTransitiontime{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 40%;border:0px solid #000000;padding: 26px 0 0 100px;">
                                <input type="text" id="hueLightsTransitiontime{{ $i }}" name="hueLightsTransitiontime" value="0" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- bri_inc -->
                <tr>
                    <td>bri_inc</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 60%;border:0px solid #000000;padding: 12px 50px 0 50px;">
                                <div id="hueLightsBri_incSlider{{ $i }}" name="hueLightsBri_incSlider" class="slider" data-slider data-step="1" data-initial-start="0" data-options="start: -254; end: 254;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="hueLightsBri_inc{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 40%;border:0px solid #000000;padding: 26px 0 0 100px;">
                                <input type="text" id="hueLightsBri_inc{{ $i }}" name="hueLightsBri_inc" value="0" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- sat_inc -->
                <tr>
                    <td>sat_inc</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 60%;border:0px solid #000000;padding: 12px 50px 0 50px;">
                                <div id="hueLightsSat_incSlider{{ $i }}" name="hueLightsSat_incSlider" class="slider" data-slider data-step="1" data-initial-start="0" data-options="start: -254; end: 254;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="hueLightsSat_inc{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 40%;border:0px solid #000000;padding: 26px 0 0 100px;">
                                <input type="text" id="hueLightsSat_inc{{ $i }}" name="hueLightsSat_inc" value="0" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- hue_inc -->
                <tr>
                    <td>hue_inc</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 60%;border:0px solid #000000;padding: 12px 50px 0 50px;">
                                <div id="hueLightsHue_incSlider{{ $i }}" name="hueLightsHue_incSlider" class="slider" data-slider data-step="1" data-initial-start="0" data-options="start: -65534; end: 65534;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="hueLightsHue_inc{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 40%;border:0px solid #000000;padding: 26px 0 0 100px;">
                                <input type="text" id="hueLightsHue_inc{{ $i }}" name="hueLightsHue_inc" value="0" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- ct_inc 
                <tr>
                    <td>ct_inc</td>
                    <td>
                        <div class="rowbox">
                            <div style="width: 60%;border:0px solid #000000;padding: 12px 50px 0 50px;">
                                <div id="ct_incSlider{{ $i }}" name="ct_incSlider" class="slider" data-slider data-step="1" data-initial-start="0" data-options="start: -65534; end: 65534;precision:null;">
                                    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="ct_inc{{ $i }}"></span>
                                    <span class="slider-fill" data-slider-fill></span>
                                </div>
                            </div>
                            <div style="width: 40%;border:0px solid #000000;padding: 26px 0 0 100px;">
                                <input type="text" id="ct_inc{{ $i }}" name="ct_inc" value="0" style="background-color: transparent;height: 20px;border-width: 0px;border: none;box-shadow: none;">
                            </div>
                        </div>
                    </td>
                </tr>-->

                <!-- xy_inc
                <tr>
                    <td>xy_inc</td>
                    <td>
                    <input type="text" name="xy_inc" id="xy_inc{{ $i }}" style="width: 250px;">
                    </td>
                </tr>-->

                <!-- ID -->
                <input type="hidden" id="hueLightsId{{ $i }}" name="hueLightsId" value="{{ $i }}">
            </tbody>
        </table>
    </div>

    <!-- Submit -->
    <div style="padding:15px 0 0 0;">
        <div style="width:50%;text-align:left;">
            <button type="submit" class="button" id="hueLightsSubmitState{{ $i }}" name="hueLightsSubmitState{{ $i }}" style="width: 100px;">Submit</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    
</script>