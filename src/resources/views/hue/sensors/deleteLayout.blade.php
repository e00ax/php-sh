@php
    //echo "<pre>";
    //print_r($sensors);
    //echo "</pre>";
@endphp

<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">Delete Hue sensors</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>
    
    <form action="{{ route('hueSensorsDelete.post') }}" method="post" id="hueSensorsDelete" name="hueSensorsDelete">
        <div class="contbox" style="padding: 20px 10px 25px 10px;text-align: left;">
            <div style="padding: 10px;background: #f8f9fa;border:1px solid #c4cad1;border-radius: 5px;">
                <table class="hover foundation">
                    <tbody>
                        <tr>
                            <td width="20%">Name:</td>
                            <td width="80%">
                                <div class="rowbox" style="padding: 25px 0 0 0;">
                                    <select class="foundation" id="hueSensorsDeleteName">
                                        @foreach ($sensors as $id => $sensor)
                                            <option value="{{ $id }}">{{ $sensor['name'] }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <!-- Submit -->
                                    <div>
                                        <div style="width:50%;text-align:left;">
                                            <button type="button" data-open="modalHueSensorsDelete" class="button" id="hueSensorsDeleteSubmit" name="hueSensorsDeleteSubmit" style="width: 100px;height: 39px;">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                

                <!-- Modal -->
                <div class="reveal shModal" id="modalHueSensorsDelete" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
                    <!-- Close -->
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="rowbox" id="modalHueSensorsDeleteHeader" style="padding:0 0 15px 0;">Perform the following action?</div>
                    <div class="rowbox" style="padding:0;background: #171717;">
                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">Action:</div>
                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">delete sensors</div>
                    </div>
                    <div class="rowbox" style="padding:0;background: #171717;">
                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">Response:</div>
                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">
                            <pre id="modalHueSensorsDeleteResponse" style="white-space: pre-wrap;">[response.text]</pre>
                        </div>
                    </div>
                    
                    <!-- Submit modal -->
                    <div class="rowbox" style="padding:15px 0 0 0;">
                        <div style="width:50%;text-align:left;">
                            <button type="submit" class="button" id="modalHueSensorsDeleteSubmit" name="modalHueSensorsDeleteSubmit" style="width: 100px;">Delete</button>
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
    $("button[name='modalHueSensorsDeleteSubmit']").click(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

        var testId = $(this).attr("id");
        var id = $("#hueSensorsDeleteName").val();
        
        // [Debug]
        alert(id);

        // Get form elements values
        //var serialArr = $(this).serializeArray();
        
        // Prepare post values
        var values = {
            "id": id
        };

        ajaxRequest = $.ajax({
            url: "{{ route('hueSensorsDelete.post') }}",
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
            $('#hueSensorsDeleteName').find('option:selected').remove();

            // Modal success response
            $('#modalHueSensorsDeleteHeader').html("Success!");
            $('#modalHueSensorsDeleteResponse').html(response);
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
            $('#modalHueSensorsDeleteHeader').html("Failure!");
            $('#modalHueSensorsDeleteResponse').html(msg);
        });

    });
</script>
