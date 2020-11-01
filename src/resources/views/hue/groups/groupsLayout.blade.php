@php
//echo "<pre>";
//print_r($groups);
//echo "</pre>";
@endphp

<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.groupsHeader') }}</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>

    <div class="contbox" style="padding: 10px;">
        <!-- Accordion -->
        <div class="row foundation">
            <div class="columns">
                <ul class="accordion" data-accordion data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge-delay="500" id="deeplinked-accordion">
                    
                    @foreach ($groups as $i => $group)
                        @php
                            $i == array_key_first($groups)
                                ? $active="active" :
                                $active="" ; 
                        @endphp

                        <!-- Accordion Item -->
                        <li class="accordion-item {{ $active }}" data-accordion-item id="accHeader{{ $i }}">
                            <a href="#deeplink{{ $i }}" class="accordion-title">{{ $groups[$i]['name'] }}</a>
                            <div id="deeplink{{ $i }}" class="accordion-content" data-tab-content style="background: #222;">
                                <div class="colbox" style="background: #f8f9fa;border:1px solid #c4cad1;padding: 10px;border-radius: 5px;border-top:0px;text-align: left;">
                                    
                                    <!-- Tabs header -->
                                    <ul class="tabs" data-active-collapse="true" data-tabs id="hueTabs{{ $i }}">
                                        <li class="tabs-title is-active"><a href="#tabInfo{{ $i }}" aria-selected="true">{{ trans('messages.tabLightsInfo') }}</a></li>
                                        <li class="tabs-title"><a href="#tabState{{ $i }}">{{ trans('messages.tabState') }}</a></li>
                                        <!-- only for colored lights from here! -->
                                        @if (isset($groups[$i]['action']['colormode']))
                                            <li class="tabs-title"><a href="#tabEffect{{ $i }}">{{ trans('messages.tabEffects') }}</a></li>
                                            <li class="tabs-title"><a href="#tabScenes{{ $i }}">{{ trans('messages.tabGroupsScenes') }}</a></li>
                                        @endif
                                        <li class="tabs-title"><a href="#tabModify{{ $i }}">{{ trans('messages.tabGroupsModify') }}</a></li>
                                    </ul>
                                    
                                    <!-- Tabs content -->
                                    <div class="tabs-content" data-tabs-content="hueTabs{{ $i }}">
                                        <div class="tabs-panel is-active" id="tabInfo{{ $i }}">
                                            @include('hue.groups.groupsLayoutTabInfo')
                                        </div>
                                        <div class="tabs-panel" id="tabState{{ $i }}">
                                            @include('hue.groups.groupsLayoutTabState')
                                        </div>
                                        <!-- only for colored lights from here! -->
                                        @if (isset($groups[$i]['action']['colormode']))
                                            <div class="tabs-panel" id="tabEffect{{ $i }}">
                                                @include('hue.groups.groupsLayoutTabEffect')
                                            </div>
                                            <div class="tabs-panel" id="tabScenes{{ $i }}">
                                                @include('hue.groups.groupsLayoutTabScenes')
                                            </div>
                                        @endif
                                        <div class="tabs-panel" id="tabModify{{ $i }}">
                                            @include('hue.groups.groupsLayoutTabModify')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /**
     * Hue lights state
     */
    $("form[name='setGroupState']").submit(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

       // [Debug]
       //alert($(this).attr("id"));

        // Get form elements values
        var values = $(this).serializeArray();

        ajaxRequest = $.ajax({
            url: "{{ route('hueGroupsSetState.post') }}",
            type: "POST",
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
     * Hue lights state
     */
    $("form[name='hueGroupsScenes']").submit(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        // [Debug]
        //alert($(this).attr("id"));

        // Get form elements values
        var values = $(this).serializeArray();

        ajaxRequest = $.ajax({
            url: "{{ route('hueGroupsScenes.post') }}",
            type: "POST",
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
     * Hue Groups Modify
     */
    $("form[name='hueGroupsModify'] button:submit").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        var split = $(this).attr("id").split("#");
        var hueid = split[1];
        var name = $('#hueGroupsModifyName' + hueid).val();
        var lights = [];
        
        // [Debug]
        //alert(hueid);

        // Get form elements values
        //var values = $("#hueGroupsModify" + hueid).serializeArray();

        $("#hueGroupsModify" + hueid + " input:checkbox").each(function() {
            if ($(this).is(':checked')) {
                split = $(this).attr("id").split("#");
                lights.push(split[2]);

                // [Debug]
                //alert($(this).attr("id"));
            }
        });

        /**
         * JS side error checking
         */
        // At least one light must be selected!
        if (lights.length === 0) {
            $('#modalHueGroupsModifyResponse' + hueid).html(">> Please select at least one light! <<");
            exit(0);
        }

        // At least a name must be selected!
        if (name == '') {
            $('#modalHueGroupsModifyResponse' + hueid).html(">> Please select at least a name! <<");
            exit(0);
        }

        // Prepare post values
        var values = {
            "id": hueid,
            "name": name,
            "lights": lights
        };
        
        ajaxRequest = $.ajax({
            url: "{{ route('hueGroupsModify.post') }}",
            type: "POST",
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

            // Change accordion title
            $('#accHeader' + hueid + ' a:first').text(name);

            // Modal success response
            $('#modalHueGroupsModifyHeader' + hueid).html("Success!");
            $('#modalHueGroupsModifyResponse' + hueid).html(response);
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
            $('#modalHueGroupsModifyHeader' + hueid).html("Failure!");
            $('#modalHueGroupsModifyResponse' + hueid).html(msg);
        });

    });
</script>