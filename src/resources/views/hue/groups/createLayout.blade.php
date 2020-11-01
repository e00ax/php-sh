@php
    //echo "<pre>";
    //print_r($lights);
    //echo "</pre>";
@endphp

<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">Create Hue light Group</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>

    <form action="{{ route('hueGroupsCreate.post') }}" method="post" id="hueGroupsCreate" name="hueGroupsCreate">
        <div class="contbox" style="padding: 20px 10px 25px 10px;text-align: left;">
            <div style="padding: 10px;background: #f8f9fa;border:1px solid #c4cad1;border-radius: 5px;">
                <table class="hover foundation">
                    <tbody>
                        <tr>
                            <td width="20%">Name:</td>
                            <td width="80%" style="padding-top: 25px;">
                                <input type="text" class="foundation" id="hueGroupsCreateName" name="hueGroupsCreateName">
                            </td>
                        </tr>
                        <tr>
                            <td>Type:</td>
                            <td style="padding-top: 25px;">
                                <select class="foundation" id="hueGroupsCreateType">
                                    <option selected>Room</option>
                                    <option>Zone</option>
                                </select>
                            </td>
                        </tr>

                        @foreach ($lights as $i => $light)
                            <tr>
                                <td><a href="{{ url('/hue/lights#deeplink'.$i) }}">{{ $lights[$i]['name'] }}</a></td>
                                <td style="padding-top: 25px;">
                                    <div id="hueGroupsCreateLights{{ $i }}" name="hueGroupsCreateLights" class="switch radius">
                                        <input id="hueGroupsCreateSwitch{{ $i }}" class="switch-input" type="checkbox" name="hueGroupsCreateSwitch{{ $i }}">
                                        <label class="switch-paddle" for="hueGroupsCreateSwitch{{ $i }}">
                                            <span class="show-for-sr">Light Control</span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Submit -->
                <div style="padding:15px 0 0 0;">
                    <div style="width:50%;text-align:left;">
                        <button type="button" data-open="modalHueGroupsCreate" class="button" id="hueGroupsCreateSubmit" name="hueGroupsCreateSubmit" style="width: 100px;">Submit</button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="reveal shModal" id="modalHueGroupsCreate" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
                    <!-- Close -->
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="rowbox" id="modalHueGroupsCreateHeader" style="padding:0 0 15px 0;">Perform the following action?</div>
                    <div class="rowbox" style="padding:0;background: #171717;">
                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">Action:</div>
                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">create light group</div>
                    </div>
                    <div class="rowbox" style="padding:0;background: #171717;">
                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">Response:</div>
                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">
                            <pre id="modalHueGroupsCreateResponse" style="white-space: pre-wrap;">[response.text]</pre>
                        </div>
                    </div>
                    
                    <!-- Submit modal -->
                    <div class="rowbox" style="padding:15px 0 0 0;">
                        <div style="width:50%;text-align:left;">
                            <button type="submit" class="button" id="modalHueGroupsCreateSubmit" name="modalHueGroupsCreateSubmit" style="width: 100px;">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    /**
     * Send hue fullset ajax data
     */
    $("button[name='modalHueGroupsCreateSubmit']").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        var id = $(this).attr("id");
        var type = $("#hueGroupsCreateType").val();
        var name = $('#hueGroupsCreateName').val();
        var lights = [];

        // [Debug]
        //alert(id);

        // Get form elements values
        //var serialArr = $(this).serializeArray();

        // Build lights array
        for (var i = 1; i <= @php echo count($lights); @endphp; i++) {
            if ($('#hueGroupsCreateSwitch' + i).is(':checked')) {
                // [Debug]
                //alert($('#hueGroupsCreateSwitch' + i).val());

                lights.push(i);
            }
        }

        /**
         * JS side error checking
         */
        // At least one light must be selected!
        if (lights.length === 0) {
            $('#modalHueGroupsCreateResponse').html(">> Please select at least one light! <<");
            exit(0);
        }

        // At least a name must be selected!
        if (name == '') {
            $('#modalHueGroupsCreateResponse').html(">> Please select at least a name! <<");
            exit(0);
        }

        // Prepare post values
        var values = {
            "name": name,
            "type": type,
            "lights": lights
        };

        ajaxRequest = $.ajax({
            url: "{{ route('hueGroupsCreate.post') }}",
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
            //alert(response);

            // Modal success response
            $('#modalHueGroupsCreateHeader').html("Success!");
            $('#modalHueGroupsCreateResponse').html(response);
        });

        // Alerts the errors
        ajaxRequest.fail(function(xhr, status, error) {
            var msg = '|====================' + "<br>" +
                '| Ajax Request failed!' + "<br>" +
                '|====================' + "<br>" +
                'Status: ' + xhr.status + "<br>" +
                'Response: ' + xhr.responseText + "<br>" +
                'Error: ' + error;

            // Modal success response
            $('#modalHueGroupsCreateHeader').html("Failure!");
            $('#modalHueGroupsCreateResponse').html(msg);
        });

    });
</script>