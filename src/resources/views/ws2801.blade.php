@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box quicksetHeader">
    <div class="rowbox headbox headline">
        <div style="border:0px solid white;padding:2px 0 0 5px;">&nbsp;</div>
        <div style="width:98%;border:0px solid white">WS2801 lightstripes</div>
    </div>

    @php
        $ws2801 = config('sh.ws2801.stripes');
        $color = config('sh.ws2801.color');
    @endphp
    
    <form action="{{ url('ws2801') }}" method="post" id="ws2801" name="ws2801">

        <!-- Content -->
        <div class="contbox" style="padding: 10px;">

            <!-- Accordion -->
            <div class="row foundation">
                <div class="columns">
                    <ul class="accordion" data-accordion>
                        
                        @for ($i = 1; $i <= count($ws2801); $i++)
                            @php
                                $i == 1
                                    ? $active = 'active'
                                    : $active = '';
                            @endphp
                            <li class="accordion-item {{ $active }}" data-accordion-item>
                                <a href="#" class="accordion-title">{{ $ws2801[$i] }}</a>

                                <div class="accordion-content" data-tab-content style="background: #222;">
                                    <div class="rowbox">
                                        <!-- Ws2801 img
                                        <div style="width: 150px;border: 0px solid black;">
                                            <img id="ws2801{{ $i }}Img" src="img/ws2801Off.png" style="max-width: 100px;">
                                        </div>-->

                                        <div style="width: 250px;padding: 18px 50px 15px 50px;border: 0px solid #000;">
                                            <input type="color" id="ws2801ColorPicker{{ $i }}" value="{{ $color }}" style="background: #222;border: none">
                                            <span class="subtext">Color</span>
                                        </div>

                                        <!-- Spectrum Color picker 
                                        <script>
                                            $(function() {
                                                $("#spectrum{{ $i }}").spectrum({
                                                    color: "{{ $color }}",
                                                    change: function(color) {
                                                        var changed = color.toHexString();

                                                        // Change input value
                                                        $("#spectrumOutput{{ $i }}").val(changed);

                                                        // Change text color
                                                        document.getElementById("spectrumOutput{{ $i }}").style.color = changed;

                                                        //alert(changed);
                                                    }
                                                });
                                            });
                                        </script>

                                        <div style="width: 100px;padding: 25px 0 0 0;border: 1px solid #000;text-align: right;">
                                            <input type="text" id="spectrum{{ $i }}" style="width:0px;height:0px">
                                        </div>

                                        <div class="foundation" style="width: 100px;padding: 28px 0 0 0;border: 1px solid #000;text-align: right;">
                                            <input type="text" id="spectrumOutput{{ $i }}" value="{{ $color }}" class="subtext" style="background: #222;height:20px;border-width:0px;border:none;box-shadow: none;color: {{ config('sh.ws2801.color') }};">
                                        </div>-->

                                        <!-- Submit -->
                                        <div class="subtext" style="border: 0px solid #000;width:250px;padding: 18px 0 0 0;text-align: center;">
                                            <button type="button" id="ws2801Submit{{ $i }}" class="button" style="background: #1779ba">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    /**
     * Send data via ajax call
     *
     */
    function ajaxCall(url, type, postData) {
        ajaxRequest = $.ajax({
            url: url,
            type: type,
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
            data: postData
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
    }


    /**
     * Manage ws2801 ajax requests
     *
     */
    $('#ws2801 button').click(function() {
        var id = $(this).attr("id").substr($(this).attr("id").length - 1, $(this).attr("id").length);

        // Get Color from color picker
        var colorHex = $('#ws2801ColorPicker' + id).val();

        // [Debug]
        //alert(id);

        // Prepare post values
        var values = {
            id: id,
            colorHex: colorHex
        }

        ajaxCall("{{ route('ws2801.post') }}", "POST", values);
    });
</script>