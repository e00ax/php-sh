<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.lightsHeader') }}</div>
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
                    @php
                        $color = config('sh.hue.color');
                    @endphp

                    @foreach ($lights as $i => $light) 
                        @php 
                            $i == array_key_first($lights) 
                                ? $active="active" 
                                : $active="" ;
                        @endphp

                    <!-- Accordion content -->
                    <li class="accordion-item {{ $active }}" data-accordion-item id="accHeader{{ $i }}">
                        <a href="#deeplink{{ $i }}" class="accordion-title">{{ $lights[$i]['name'] }}</a>
                        <div id="deeplink{{ $i }}" class="accordion-content" data-tab-content style="background: #222;">
                            <div class="colbox" style="background: #f8f9fa;border:1px solid #c4cad1;padding: 10px;border-radius: 5px;border-top:0px;text-align: left;">
                                <ul class="tabs" data-active-collapse="true" data-tabs id="hueTabs{{ $i }}">
                                    <li class="tabs-title is-active"><a href="#tabInfo{{ $i }}" aria-selected="true">{{ trans('messages.tabLightsInfo') }}</a></li>
                                    <li class="tabs-title"><a href="#tabState{{ $i }}">{{ trans('messages.tabState') }}</a></li>
                                    <!-- only for colored lights from here! -->
                                    @if (isset($lights[$i]['state']['colormode']))
                                        <li class="tabs-title"><a href="#tabEffect{{ $i }}">{{ trans('messages.tabEffects') }}</a></li>
                                    @endif
                                    <li class="tabs-title"><a href="#tabRename{{ $i }}">{{ trans('messages.tabRename') }}</a></li>
                                </ul>

                                <div class="tabs-content" data-tabs-content="hueTabs{{ $i }}">
                                    <div class="tabs-panel is-active" id="tabInfo{{ $i }}">
                                        @include('hue.lights.lightsLayoutTabInfo')
                                    </div>
                                    <div class="tabs-panel" id="tabState{{ $i }}">
                                        @include('hue.lights.lightsLayoutTabState')
                                    </div>
                                    <!-- only for colored lights from here! -->
                                    @if (isset($lights[$i]['state']['colormode']))
                                        <div class="tabs-panel" id="tabEffect{{ $i }}">
                                            @include('hue.lights.lightsLayoutTabEffect')
                                        </div>
                                    @endif
                                    <div class="tabs-panel" id="tabRename{{ $i }}">
                                        @include('hue.lights.lightsLayoutTabRename')
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
    $("form[name='setLightState']").submit(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        // Get form elements values
        var values = $(this).serializeArray();

        ajaxRequest = $.ajax({
            url: "{{ route('hueLightsSetState.post') }}",
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
     * Hue lights rename
     */
    $("form[name='hueLightsRename'] button:submit").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        var split = $(this).attr("id").split("#");
        var hueid = split[1];
        var id = $('#hueLightsId' + hueid).val();
        var name = $('#hueLightsName' + hueid).val();

        // [Debug]
        //alert($(this).attr("id"));

        // Prepare post values
        var values = {
            "id": id,
            "name": name
        }

        ajaxRequest = $.ajax({
            url: "{{ route('hueLightsRename.post') }}",
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

            // Change accordion title
            $('#accHeader' + hueid + ' a:first').text(name);

            // Modal success response
            $('#modalHueLightsRenameHeader' + hueid).html("Success!");
            $('#modalHueLightsRenameResponse' + hueid).html(response);
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
            $('#modalHueLightsRenameHeader' + hueid).html("Failure!");
            $('#modalHueLightsRenameResponse' + hueid).html(msg);
        });
    });
</script>