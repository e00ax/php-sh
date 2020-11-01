@php
    //echo "<pre>";
    //print_r($rules);
    //echo "</pre>";
@endphp

<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.rulesDeleteHeader') }}</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>
    
    <form action="{{ route('hueRulesDelete.post') }}" method="post" id="hueRulesDelete" name="hueRulesDelete">
        <div class="contbox" style="padding: 20px 10px 25px 10px;text-align: left;">
            <div style="padding: 10px;background: #f8f9fa;border:1px solid #c4cad1;border-radius: 5px;">
                <table class="hover foundation">
                    <tbody>
                        <tr>
                            <td width="20%">Name:</td>
                            <td width="80%">
                                <div class="rowbox" style="padding: 25px 0 0 0;">
                                    <select class="foundation" id="hueRulesDeleteName">
                                        @foreach ($rules as $id => $rule)
                                            <option value="{{ $id }}">{{ $rule['name'] }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <!-- Submit -->
                                    <div>
                                        <div style="width:50%;text-align:left;">
                                            <button type="button" data-open="modalHueRulesDelete" class="button" id="hueRulesDeleteSubmit" name="hueRulesDeleteSubmit" style="width: 100px;height: 39px;">{{ trans('messages.delete') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                

                <!-- Modal -->
                <div class="reveal shModal" id="modalHueRulesDelete" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
                    <!-- Close -->
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="rowbox" id="modalHueRulesDeleteHeader" style="padding:0 0 15px 0;">{{ trans('messages.header') }}?</div>
                    <div class="rowbox" style="padding:0;background: #171717;">
                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionHeader') }}:</div>
                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.rulesActionDelete') }}</div>
                    </div>
                    <div class="rowbox" style="padding:0;background: #171717;">
                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.responseHeader') }}:</div>
                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">
                            <pre id="modalHueRulesDeleteResponse" style="white-space: pre-wrap;">{{ trans('messages.response') }}</pre>
                        </div>
                    </div>
                    
                    <!-- Submit modal -->
                    <div class="rowbox" style="padding:15px 0 0 0;">
                        <div style="width:50%;text-align:left;">
                            <button type="submit" class="button" id="modalHueRulesDeleteSubmit" name="modalHueRulesDeleteSubmit" style="width: 100px;">{{ trans('messages.delete') }}</button>
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
    $("button[name='modalHueRulesDeleteSubmit']").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        var testId = $(this).attr("id");
        var id = $("#hueRulesDeleteName").val();
        
        // [Debug]
        alert(id);

        // Get form elements values
        //var serialArr = $(this).serializeArray();
        
        // Prepare post values
        var values = {
            "id": id
        };

        ajaxRequest = $.ajax({
            url: "{{ route('hueRulesDelete.post') }}",
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

            // Delete selected visual
            $('#hueRulesDeleteName').find('option:selected').remove();

            // Modal success response
            $('#modalHueRulesDeleteHeader').html("Success!");
            $('#modalHueRulesDeleteResponse').html(response);
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
            $('#modalHueRulesDeleteHeader').html("Failure!");
            $('#modalHueRulesDeleteResponse').html(msg);
        });

    });
</script>