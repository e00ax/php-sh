@php
//echo "<pre>";
//print_r($sensors);
//echo "</pre>";
@endphp

<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.sensorsHeader') }}</div>
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
                    @foreach ($sensors as $i => $sensor) 
                        @php 
                            $i == array_key_first($sensors) 
                                ? $active="active" 
                                : $active="" ;
                        @endphp

                    <!-- Accordion content -->
                    <li class="accordion-item {{ $active }}" data-accordion-item id="accHeader{{ $i }}">
                        <a href="#deeplink{{ $i }}" class="accordion-title">{{ $sensors[$i]['name'] }}</a>
                        <div id="deeplink{{ $i }}" class="accordion-content" data-tab-content style="background: #222;">
                            <div class="colbox" style="background: #f8f9fa;border:1px solid #c4cad1;padding: 10px;border-radius: 5px;border-top:0px;text-align: left;">
                                <ul class="tabs" data-active-collapse="true" data-tabs id="hueTabs{{ $i }}">
                                    <li class="tabs-title is-active"><a href="#tabInfo{{ $i }}" aria-selected="true">{{ trans('messages.tabLightsInfo') }}</a></li>
                                    <li class="tabs-title"><a href="#tabRename{{ $i }}">{{ trans('messages.tabRename') }}</a></li>
                                </ul>

                                <div class="tabs-content" data-tabs-content="hueTabs{{ $i }}">
                                    <div class="tabs-panel is-active" id="tabInfo{{ $i }}">
                                        @include('hue.sensors.sensorsLayoutTabInfo')
                                    </div>
                                    <div class="tabs-panel" id="tabRename{{ $i }}">
                                        @include('hue.sensors.sensorsLayoutTabRename')
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
     * Hue sensors rename
     */
    $("form[name='hueSensorsRename'] button:submit").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        var split = $(this).attr("id").split("#");
        var hueid = split[1];
        var id = $('#hueSensorsId' + hueid).val();
        var name = $('#hueSensorsName' + hueid).val();

        // [Debug]
        //alert($(this).attr("id"));

        // Prepare post values
        var values = {
            "id": id,
            "name": name
        }

        ajaxRequest = $.ajax({
            url: "{{ route('hueSensorsRename.post') }}",
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

            // Change accordion title
            $('#accHeader' + hueid + ' a:first').text(name);

            // Modal success response
            $('#modalHueSensorsRenameHeader' + hueid).html("Success!");
            $('#modalHueSensorsRenameResponse' + hueid).html(response);
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
            $('#modalHueSensorsRenameHeader' + hueid).html("Failure!");
            $('#modalHueSensorsRenameResponse' + hueid).html(msg);
        });
    });
</script>