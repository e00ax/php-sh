@php
//echo "<pre>";
//print_r($groups);
//echo "</pre>";
@endphp

<!--{{ $name }}-->

<form action="{{ route('hueRulesCreate.post') }}" method="post" id="hueRulesCreate" name="hueRulesCreate">
    <div class="contbox" style="padding: 20px 10px 25px 10px;text-align: left;">
        <div style="padding: 10px;background: #f8f9fa;border:1px solid #c4cad1;border-radius: 5px;">
            <table class="hover foundation">
                <tbody>
                    <tr>
                        <td width="25%">Name:</td>
                        <td width="75%">
                            <div class="rowbox" style="padding: 25px 0 0 0;">
                                <input type="text" id="name" name="name" style="height: 40px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">Button:</td>
                        <td width="80%">
                            <div class="rowbox" style="padding: 25px 0 0 0;">
                                <select class="foundation" id="button" name="button">
                                    <option value="1000">Button 1 [INITIAL_PRESS]</option>
                                    <option value="1001">Button 1 [HOLD]</option>
                                    <option value="1002">Button 1 [SHORT_RELEASED]</option>
                                    <option value="1003">Button 1 [LONG_RELEASED]</option>
                                    <option value="2000">Button 2 [INITIAL_PRESS]</option>
                                    <option value="2001">Button 2 [HOLD]</option>
                                    <option value="2002">Button 2 [SHORT_RELEASED]</option>
                                    <option value="2003">Button 2 [LONG_RELEASED]</option>
                                    <option value="3000">Button 3 [INITIAL_PRESS]</option>
                                    <option value="3001">Button 3 [HOLD]</option>
                                    <option value="3002">Button 3 [SHORT_RELEASED]</option>
                                    <option value="3003">Button 3 [LONG_RELEASED]</option>
                                    <option value="4000">Button 4 [INITIAL_PRESS]</option>
                                    <option value="4001">Button 4 [HOLD]</option>
                                    <option value="4002">Button 4 [SHORT_RELEASED]</option>
                                    <option value="4003">Button 4 [LONG_RELEASED]</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Target [group]:</td>
                        <td>
                            <div class="rowbox" style="padding: 25px 0 0 0;">
                                <select class="foundation" id="targetGroup" name="targetGroup">
                                @foreach ($groups as $id => $group)
                                    <option value="{{ $id }}">{{ $groups[$id]['name'] }}</option>
                                @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Target [sensor]:</td>
                        <td>
                            <div class="rowbox" style="padding: 25px 0 0 0;">
                                <select class="foundation" id="targetSensor" name="targetSensor">
                                @foreach ($sensors as $id => $sensor)
                                    <option value="{{ $id }}">{{ $sensors[$id]['name'] }}</option>
                                @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Condition [any_on]:</td>
                        <td>
                            <div class="rowbox" style="padding: 25px 0 0 0;">
                                <select class="foundation" id="condition" name="condition">
                                    <option value="true">TRUE</option>
                                    <option value="false">FALSE</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Action:</td>
                        <td>
                            <div class="rowbox" style="padding: 25px 0 0 0;">
                                <select class="foundation" id="action" name="action">
                                    <option value="ON">ON</option>
                                    <option value="OFF">OFF</option>
                                    <option value="SCENE">SCENE</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr id="scene" style="display: none;">
                        <td>Scene:</td>
                        <td>
                            <div class="rowbox" style="padding: 25px 0 0 0;">
                                <select class="foundation" id="scene" name="scene">
                                @foreach (config('scenes') as $key => $val)
                                    <option value="{{ $key }}">{{ $key }}</option>
                                @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Submit -->
            <div class="rowbox" style="padding:15px 0 0 0;">
                <div style="width:50%;text-align:left;">
                    <button type="submit" class="button" id="hueRulesCreateSubmit" name="hueRulesCreateSubmit" style="width: 100px;">{{ trans('messages.create') }}</button>
                </div>
            </div>

            <!-- Modal -->
            <div class="reveal shModal" id="modalHueRulesCreate" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
                <!-- Close -->
                <button class="close-button" data-close aria-label="Close modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="rowbox" id="modalHueRulesCreateHeader" style="padding:0 0 15px 0;">{{ trans('messages.header') }}?</div>
                <div class="rowbox" style="padding:0;background: #171717;">
                    <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionHeader') }}:</div>
                    <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.rulesActionCreate') }}</div>
                </div>
                <div class="rowbox" style="padding:0;background: #171717;">
                    <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.ResponseHeader') }}:</div>
                    <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">
                        <pre id="modalHueRulesCreateResponse" style="white-space: pre-wrap;">{{ trans('messages.response') }}</pre>
                    </div>
                </div>
                    
                <!-- Submit modal -->
                <div class="rowbox" style="padding:15px 0 0 0;">
                    <div style="width:50%;text-align:left;">
                        <button type="submit" class="button" id="modalHueRulesCreateSubmit" name="modalHueRulesCreateSubmit" style="width: 100px;">{{ trans('messages.create') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    // Call Foundation, because this blade file was loaded separately
    $(document).foundation();

    /**
     * Toggle visibility if scene is selected
     */
    $("form[name='hueRulesCreate'] select[name='action']").change(function(event) {
        // [Debug]
        //alert($(this).attr('id'));

        if ($(this).val() == 'SCENE') {
            $('#scene').toggle();   
        } else {
            if ($('#scene').is(":visible")) {
                $('#scene').toggle();
            }
        }
    });


    /**
     * Submit sensor rule
     */
    $("form[name='hueRulesCreate']").submit(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        // Get form elements values
        var values = $(this).serializeArray();

        ajaxRequest = $.ajax({
            url: "{{ route('hueRulesCreate.post') }}",
            type: "POST",
            /**
             * Send headers with cross domain attributes
             *
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
             */
            headers: {
                // Modify ajax header for CSRF
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

                // Basic Authorization
                //'Authorization': 'Basic ' + btoa('trainer:rat77chr'),

                // Content type
                'Content-type': 'application/x-www-form-urlencoded'
            },
            data: values
        });

        // Alerts the results
        ajaxRequest.done(function(response, textStatus, jqXHR) {
            alert(response);

            // Modal success response
            //$('#modalHueRulesCreateHeader').html("Success!");
            //$('#modalHueRulesCreateResponse').html(response);
        });

        // Alerts the errors
        ajaxRequest.fail(function(xhr, status, error) {
            alert('|====================' + "\n" +
                '| Ajax Request failed!' + "\n" +
                '|====================' + "\n" +
                'Status: ' + xhr.status + "\n" +
                'Response: ' + xhr.responseText + "\n" +
                'Error: ' + error);

            // Modal failure response
            //$('#modalHueRulesCreateHeader').html("Failure!");
            //$('#modalHueRulesCreateResponse').html(msg);
        });
    });
</script>