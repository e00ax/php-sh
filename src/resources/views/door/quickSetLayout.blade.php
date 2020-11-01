<!-- Hue lights quickset -->
<div class="box quicksetHeader">
    <div class="headbox headline">{{ trans('messages.doorControl') }}</div>

    <div class="contbox" style="padding: 20px 10px 25px 10px;text-align: left;">
        <!-- Accordion -->
        <div class="row foundation">
            <div class="columns">
                <ul class="accordion" data-accordion style="text-align: left;">

                    <!-- Front door -->
                    <li class="accordion-item is-active" data-accordion-item>
                        <a href="#" class="accordion-title" style="background: #222;border: 0px;">
                            <span>>&nbsp;{{ trans('messages.frontDoor') }}</span>
                        </a>
                        <div class="accordion-content" data-tab-content style="background: #222;border: 0px;">
                            <form action="#" method="post" id="frontDoor" name="frontDoor">
                                <div class="rowbox" style="padding: 10px 10px 0 10px;background: #f8f9fa;border: 1px solid #c4cad1;border-radius: 5px;">
                                    <div style="width: 100%;">
                                        <table class="hover foundation" style="text-align: center;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img id="frontDoorImg" src="img/frontDoorOff.png" style="width: 60px;border: 0;">
                                                    </td>
                                                    <td style="padding: 18px 25px 0 25px;">
                                                        <button type="button" data-open="modalFrontDoor" class="button" id="frontDoorSubmit" name="frontDoorSubmit" style="width: 100px;height: 39px;">{{ trans('messages.open') }}</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="reveal shModal" id="modalFrontDoor" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
                                    <!-- Close -->
                                    <button type="button" class="close-button" data-close aria-label="Close modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <div class="rowbox" id="modalFrontDoorHeader" style="padding:0 0 15px 0;">{{ trans('messages.header') }}?</div>
                                    <div class="rowbox" style="padding:0;background: #171717;">
                                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionHeader') }}:</div>
                                        <div class="contbox numsmall" id="modalNukiAction" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionFrontDoor') }}</div>

                                        <!-- Hidden lock action field -->
                                        <input type="hidden" id="action">
                                    </div>
                                    <div class="rowbox" style="padding:0;background: #171717;">
                                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.responseHeader') }}:</div>
                                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">
                                            <pre id="modalFrontDoorResponse" style="white-space: pre-wrap;">{{ trans('messages.response') }}</pre>
                                        </div>
                                    </div>

                                    <!-- Submit modal -->
                                    <div class="rowbox" style="padding:15px 0 0 0;">
                                        <div style="width:50%;text-align:left;">
                                            <button type="submit" class="button" id="modalFrontDoorSubmit" name="modalFrontDoorSubmit" style="width: 100px;">{{ trans('messages.open') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <!-- Appartment door -->
                    <li class="accordion-item" data-accordion-item>
                        <a href="#" class="accordion-title" style="background: #222;border: 0px;">
                            <span>>&nbsp;{{ trans('messages.appartmentDoor') }}</span>
                        </a>
                        <div class="accordion-content" data-tab-content style="background: #222;border: 0px;">
                            <form action="#" method="post" id="appartmentDoor" name="appartmentDoor">
                                <div class="rowbox" style="padding: 10px 10px 0 10px;background: #f8f9fa;border: 1px solid #c4cad1;border-radius: 5px;">
                                    <div style="width: 100%;">
                                        <table class="hover foundation" style="text-align: center;">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img id="appartmentDoorImg" src="img/frontDoorOff.png" style="width: 60px;border: 0;">
                                                    </td>
                                                    <td style="padding: 18px 25px 0 25px;">
                                                        <button type="button" data-open="modalAppartmentDoor" class="button" id="appartmentDoorSubmit" name="appartmentDoorSubmit" style="min-width: 100px;height: 39px;">{{ trans('messages.unlatch') }}</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- Modal -->
                                <div class="reveal shModal" id="modalAppartmentDoor" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
                                    <!-- Close -->
                                    <button type="button" class="close-button" data-close aria-label="Close modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>

                                    <div class="rowbox" id="modalAppartmentDoorHeader" style="padding:0 0 15px 0;">{{ trans('messages.header') }}?</div>
                                    <div class="rowbox" style="padding:0;background: #171717;">
                                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionHeader') }}:</div>
                                        <div class="contbox numsmall" id="modalNukiAction" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionAppartmentDoor') }}</div>

                                        <!-- Hidden lock action field -->
                                        <input type="hidden" id="action">
                                    </div>
                                    <div class="rowbox" style="padding:0;background: #171717;">
                                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.responseHeader') }}:</div>
                                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">
                                            <pre id="modalAppartmentDoorResponse" style="white-space: pre-wrap;">{{ trans('messages.response') }}</pre>
                                        </div>
                                    </div>

                                    <!-- Submit modal -->
                                    <div class="rowbox" style="padding:15px 0 0 0;">
                                        <div style="width:50%;text-align:left;">
                                            <button type="submit" class="button" id="modalAppartmentDoorSubmit" name="modalAppartmentDoorSubmit" style="min-width: 100px;">{{ trans('messages.unlatch') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /**
     * Set appartment door state
     */
    $("button[name='modalAppartmentDoorSubmit']").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        // [Debug]
        //alert($(this).attr("id"));

        // Change img to open
        $("#appartmentDoorImg").attr("src", "img/frontDoorOn.png");
        
        // Prepare post values
        var values = {
            "action": "unlatch"
        };

        // [Debug]
        //alert($(this).attr("id"));

        // Get form elements values
        //var values = $('#frontDoor').serializeArray();

        ajaxRequest = $.ajax({
            url: "{{ route('nuki.post') }}",
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
            $('#modalAppartmentDoorHeader').html("Success!");
            $('#modalAppartmentDoorResponse').html(response);
        });

        // Alerts the errors
        ajaxRequest.fail(function(xhr, status, error) {
            var msg = '|====================' + "\n" +
                '| Ajax Request failed!' + "\n" +
                '|====================' + "\n" +
                'Status: ' + xhr.status + "\n" +
                'Response: ' + xhr.responseText + "\n" +
                'Error: ' + error;

            // Modal failure response
            $('#modalAppartmentDoorHeader').html("Failure!");
            $('#modalAppartmentDoorResponse').html(msg);
        });

        // Change back img
        $("#appartmentDoorImg").attr("src", "img/frontDoorOff.png");
    });


    /**
     * Set front door state
     */
    $("button[name='modalFrontDoorSubmit']").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        // Change img to open
        $("#frontDoorImg").attr("src", "img/frontDoorOn.png");
        
        // Create post object
        var values = {
            'state': 0
        };

        ajaxRequest = $.ajax({
            url: "{{ route('door.post') }}",
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
            $('#modalFrontDoorHeader').html("Success!");
            $('#modalFrontDoorResponse').html(response);
        });

        // Alerts the errors
        ajaxRequest.fail(function(xhr, status, error) {
            var msg = '|====================' + "\n" +
                '| Ajax Request failed!' + "\n" +
                '|====================' + "\n" +
                'Status: ' + xhr.status + "\n" +
                'Response: ' + xhr.responseText + "\n" +
                'Error: ' + error;

            // Modal failure response
            $('#modalFrontDoorHeader').html("Failure!");
            $('#modalFrontDoorResponse').html(msg);
        });

        // Change back img
        $("#frontDoorImg").attr("src", "img/frontDoorOff.png");
    });
</script>