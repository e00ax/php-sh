<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.canvasJsHeader') }}</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="contbox" style="padding: 10px;">
        @php
        // Double encode data pagination object to json
        $jsonData = json_encode($data->items(), JSON_NUMERIC_CHECK);
        //print_r($jsonData);
        @endphp

        <!-- Print Canvas Js chart -->
        <div id="canvasJs" style="height: 500px;"></div>

        <!-- Pagination -->
        <div class="rowbox" style="text-align: left;background: #f2f5ff;padding-top:20px;">
            <div style="width: 75%;">{{ $data->links() }}</div>

            <!-- Items per page -->
            <div style="width:15%;padding: 0 25px 0 0;">
                <label class="text-right">
                    <select id="itemsPerPage">
                        @foreach (config('sh.pagination.optionsChart') as $key => $val)
                            @php
                                $val == $itemsPerPage
                                    ? $sel="selected" 
                                    : $sel="" ;
                            @endphp
                            <option value="{{ $val }}" {{ $sel }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </label>

                <input type="hidden" id="itemsPerPageHidden" name="itemsPerPageHidden" value="{{ $itemsPerPage }}">
            </div>

            <!-- Display data as table -->
            <div style="width:10%;padding: 0 25px 10px 10px;text-align: right;">
                <a href="{{ url('pagination') }}"><img id="tableImg" src="img/tableBig.png" style="border: 0px;width: 40px;"></a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /**
     * On Page load
     *
     */
    $(document).ready(function() {
        canvas_line_chart();
    });


    /**
     * Modify ajax header for CSRF
     *
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    /**
     * Send data via ajax call
     *
     */
    function ajaxCall(url) {
        ajaxRequest = $.ajax({
            url: url
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
     * Paginate items per page
     *
     */
    $(document).on('change', '#itemsPerPage', function(event) {
    //$("#itemsPerPage").change(function(event) {
        var itemsPerPage = $("#itemsPerPage option:selected").val();
        //var url = $(location).attr('href');
        //var page = url.split('page=')[1];

        // [Debug]
        //alert(itemsPerPage);

        // HTTP page redirect
        $(location).attr('href', "{{ $data->url(1) }}&items=" + itemsPerPage);

        // Ajax Call
        //ajaxCall("{{ route('canvasJs.get') }}?page=1&items=" + itemsPerPage);
    }); 
    

    /**
	 * Paginate links
     *
	 */
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var itemsPerPageHidden = $('#itemsPerPageHidden').val();

        // [Debug]
        //alert(itemsPerPageHidden);

        // HTTP page redirect
        $(location).attr('href', "{{ $data->url(1) }}&items=" + "{{ $itemsPerPage }}&page=" + page);
        
        // Ajax call
        //ajaxCall("{{ route('canvasJs.get') }}?page=" + page + "&items=" + itemsPerPageHidden);
        
        // Print canvasJs line chart
        //canvas_line_chart();
    });
    


    /**
     * CanvasJS line chart
     *
     */
    function canvas_line_chart() {
        var jsonData = @php echo json_encode($jsonData, JSON_NUMERIC_CHECK); @endphp;
        var obj = $.parseJSON(jsonData);

        var dataPointsTemp = [];
        var dataPointsHum = [];
        var time = "";

        // [debug]
        //alert(obj[0].timestamp);

        // Build canvas x,y data array
        for (var i = 0; i < obj.length; i++) {
            time = new Date(obj[i].timestamp);

            // Temperature data points
            dataPointsTemp.push({
                x: time,
                y: obj[i].temp
            });

            // Humidity data points
            dataPointsHum.push({
                x: time,
                y: obj[i].hum
            });
        }

        // [debug]
        //alert(JSON.stringify(dataPointsTemp));

        // Chart options
        var options = {
            animationEnabled: true,
            theme: "light2",
            //backgroundColor: "#f2f5ff",
            title: {
                text: "Wohnzimmer"
            },
            axisX: {
                valueFormatString: "HH:mm",
                crosshair: {
                    enabled: true,
                    snapToDataPoint: true
                }
            },
            axisY: {
                //title: "°C\n%",
                //suffix: "",
                interval: 10,
                minimum: 0,
                maximum: 80,
                crosshair: {
                    enabled: true
                }
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "bottom",
                horizontalAlign: "left",
                dockInsidePlotArea: true,
                itemclick: toogleDataSeries
            },
            data: [{
                    type: "line",
                    lineDashType: "solid",
                    showInLegend: true,
                    name: "Temperatur",
                    markerType: "square",
                    xValueFormatString: "DD MMM, YYYY HH:mm:ss",
                    color: "#F08080",
                    yValueFormatString: '###.##' + '°C',
                    dataPoints: dataPointsTemp
                },
                {
                    type: "line",
                    showInLegend: true,
                    name: "Luftfeuchtigkeit",
                    lineDashType: "dash",
                    yValueFormatString: '###.##',
                    dataPoints: dataPointsHum
                }
            ]
        };

        // Print chart
        $("#canvasJs").CanvasJSChart(options);

        // Toggle data
        function toogleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            e.chart.render();
        }
    }
</script>