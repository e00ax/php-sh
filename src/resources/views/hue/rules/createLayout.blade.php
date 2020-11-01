@php
    //echo "<pre>";
    //print_r($rules);
    //echo "</pre>";

    echo $name ?? '';
@endphp

<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.rulesCreateHeader') }}</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>
    
    <form action="{{ route('hueRulesSelect.post') }}" method="post" id="hueRulesSelect" name="hueRulesSelect">
    @csrf
        <div class="contbox" style="padding: 20px 10px 25px 10px;text-align: left;">
            <div style="padding: 10px;background: #f8f9fa;border:1px solid #c4cad1;border-radius: 5px;">
                <table class="hover foundation">
                    <tbody>
                        <tr>
                            <td width="20%">Name:</td>
                            <td width="80%">
                                <div class="rowbox" style="padding: 25px 0 0 0;">
                                    <select class="foundation" id="hueRulesSelectName">
                                        <option value="dimmerSwitch">Dimmer Switch</option>
                                        <option value="smartButton">Smart Button</option>
                                    </select>
                                    
                                    <!-- Submit -->
                                    <div>
                                        <div style="width:50%;text-align:left;">
                                            <button type="submit" class="button" id="hueRulesSelectSubmit" name="hueRulesSelectSubmit" style="width: 100px;height: 39px;">{{ trans('messages.submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>

    <!-- Container for [sensor]Layout.blade -->
    <div class="containerClass"></div>
</div>

<script type="text/javascript">
    /**
     * Select sensor by name
     */
    $("form[name='hueRulesSelect']").submit(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        var testId = $(this).attr("id");
        var name = $("#hueRulesSelectName").val();
        
        // [Debug]
        //alert(name);

        // Get form elements values
        //var serialArr = $(this).serializeArray();
        
        // Prepare post values
        var values = {
            "name": name
        };

        ajaxRequest = $.ajax({
            url: "{{ route('hueRulesSelect.post') }}",
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
            
            // Display [sensor]Layout.blade file in container
            $('.containerClass').html(response);
        });

        // Alerts the errors
        ajaxRequest.fail(function(xhr, status, error) {
            alert('|====================' + "<br>" +
                '| Ajax Request failed!' + "<br>" +
                '|====================' + "<br>" +
                'Status: ' + xhr.status + "<br>" +
                'Response: ' + xhr.responseText + "<br>" +
                'Error: ' + error);
        });
    });
</script>