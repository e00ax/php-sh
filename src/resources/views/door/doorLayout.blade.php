@php
    $service = '';
    $disabled = '';
    $checked = '';

    if ($frontDoorBellState == "0") {
        $img = "Off";
    } elseif ($frontDoorBellState == "1") {
        $checked = "checked";
        $img = "On";
    } else {
        $img = 'Na';
        $service = 'Service not available!';
        $disabled = 'disabled';
    }

    //[Debug]
    //print_r($frontDoorBellState);
@endphp

<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.doorControl') }}</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="contbox" style="padding: 10px;">

        <!-- Accordion -->
        <div class="row foundation">
            <div class="columns">
                <ul class="accordion" data-accordion>

                    <!-- Front door -->
                    <li class="accordion-item active" data-accordion-item>
                        <a href="#" class="accordion-title">{{ trans('messages.frontDoor') }}</a>
                        <div class="accordion-content" data-tab-content style="background: #222;">
                            <div class="rowbox" style="padding: 10px 10px 0 10px;background: #f8f9fa;border: 1px solid #c4cad1;border-radius: 5px;">
                                <div style="width: 100%;">
                                    <table class="hover foundation" style="text-align: center;">
                                        <tbody>

                                            <!-- Doorbell -->
                                            <tr>
                                                <td class="headlineTable">
                                                    <img id="frontDoorBellImg" src="img/frontDoorBell{{ $img }}.png" style="width: 100px;">
                                                </td>
                                                <td style="padding: 15px 25px 0 25px;">
                                                    <div class="switch" style="padding: 0 57% 0 43%;border: 0px solid #000;">
                                                        <input id="frontDoorBellSwitch" class="switch-input" {{ $disabled }} type="checkbox" name="frontDoorBellSwitch" {{ $checked }}>
                                                        <input type="hidden" id="frontDoorBellState" name="frontDoorBellState">

                                                        <label class="switch-paddle" for="frontDoorBellSwitch">
                                                            <span class="show-for-sr">Bell control</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Front door -->
                                            <tr>
                                                <td>
                                                    <img id="frontDoorImg" src="img/frontDoorOff.png" style="width: 60px;border: 0;">
                                                </td>
                                                <td style="padding: 18px 25px 0 25px;">
                                                    <button type="button" data-open="modalFrontDoor" class="button" style="width: 100px;" id="frontDoorOpen">{{ trans('messages.open') }}</button>
                                                </td>

                                                <!-- Modal -->
                                                <div class="reveal shModal" id="modalFrontDoor" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
                                                    <!-- Close -->
                                                    <button class="close-button" data-close aria-label="Close modal" type="button">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>

                                                    <div class="rowbox" id="modalFrontDoorHeader" style="padding:0 0 15px 0;">{{ trans('messages.header') }}?</div>
                                                    <div class="rowbox" style="padding:0;background: #171717;">
                                                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionHeader') }}:</div>
                                                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionFrontDoor') }}</div>
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
                                                            <button type="submit" class="button" id="modalFrontDoorSubmit" name="modalFrontDoorSubmit" style="width: 100px;">{{ trans('messages.submit') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Appartment door -->
                    <li class="accordion-item" data-accordion-item>
                        <a href="#" class="accordion-title">{{ trans('messages.appartmentDoor') }}</a>
                        <div class="accordion-content" data-tab-content style="background: #222;">
                            <div class="colbox" style="background: #f8f9fa;border:1px solid #c4cad1;padding: 10px;border-radius: 5px;text-align: left;">
                                <!-- Tabs header -->
                                <ul class="tabs" data-active-collapse="true" data-tabs id="appartmentDoorTabs">
                                    <li class="tabs-title is-active"><a href="#tabInfo" aria-selected="true">{{ trans('messages.tabNukiInfo') }}</a></li>
                                    <li class="tabs-title"><a href="#tabList">{{ trans('messages.tabNukiList') }}</a></li>
                                    <li class="tabs-title"><a href="#tabState">{{ trans('messages.tabAction') }}</a></li>
                                </ul>

                                <!-- Tabs content -->
                                <div class="tabs-content" data-tabs-content="appartmentDoorTabs">
                                    <div class="tabs-panel is-active" id="tabInfo">
                                        @include('door.doorLayoutTabInfo')
                                    </div>
                                    <div class="tabs-panel" id="tabList">
                                        @include('door.doorLayoutTabList')
                                    </div>
                                    <div class="tabs-panel" id="tabState">
                                        @include('door.doorLayoutTabState')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    /**
     * Helper
     * Store action temporary in hidden field
     */
    $("form[name='nuki'] button[name='action']").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        // [Debug]
        //alert($(this).text());

        $('#modalNukiAction').html($(this).attr("id"));
        $('#action').val($(this).attr("id"));
    });


    /**
     * Set Nuki door state
     */
    $("form[name='nuki'] button:submit").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        // [Debug]
        //alert($(this).attr("id"));

        // Get form elements values
        //var values = $(this).serializeArray();

        // Prepare post values
        var values = {
            "action": $('#action').val()
        };

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
            $('#modalNukiHeader').html("Success!");
            $('#modalNukiResponse').html(response);
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
            $('#modalNukiHeader').html("Failure!");
            $('#modalNukiResponse').html(msg);
        });
    });


    /**
     * Set bell state
     */
    $("#frontDoorBellSwitch").click(function(event) {
        var id = $(this).attr("id");

        // [Debug]
        //alert(id);

        // Switch is checked
        if ($(this).is(':checked')) {
            state = 1;
            $("#frontDoorBellImg").attr("src", "img/frontDoorBellOn.png");

            // Switch is unchecked
        } else {
            state = 0;
            $("#frontDoorBellImg").attr("src", "img/frontDoorBellOff.png");
        }

        // Create post object
        var values = {
            'state': state
        };

        ajaxRequest = $.ajax({
            url: "{{ route('bell.post') }}",
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
        });

        // Alerts the errors
        ajaxRequest.fail(function(xhr, status, error) {
            alert(
                '|====================' + "\n" +
                '| Ajax Request failed!' + "\n" +
                '|====================' + "\n" +
                'Status: ' + xhr.status + "\n" +
                'Response: ' + xhr.responseText + "\n" +
                'Error: ' + error
            );
        });
    });


    /**
     * Set front door state
     */
    $("#modalFrontDoorSubmit").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        var id = $(this).attr("id");

        // [Debug]
        //alert(id);

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
            var msg = '|====================' + "<br>" +
                '| Ajax Request failed!' + "<br>" +
                '|====================' + "<br>" +
                'Status: ' + xhr.status + "<br>" +
                'Response: ' + xhr.responseText + "<br>" +
                'Error: ' + error;

            // Modal failure response
            $('#modalFrontDoorHeader').html("Failure!");
            $('#modalFrontDoorResponse').html(response);
        });
    });
</script>