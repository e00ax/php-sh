<div class="box quicksetHeader" style="max-height: 325px;">
	<div class="rowbox headbox headline">
		<div style="border:0px solid white;padding:2px 0 0 5px;">&nbsp;</div>
		<div style="width:98%;border:0px solid white">{{ trans('messages.heater') }}</div>
	</div>

	<form action="{{ route('heaterQuickSet.post') }}" method="post" id="heater" name="heater">
		<div class="rowbox">
			@php
				$heaterState == 0
					? $checked = "checked"
					: $checked = "";
			@endphp

			<!-- Power -->
			<div class="contbox numbig" style="padding-top:85px;">
				<div class="switch">
					<input id="heaterSwitch" class="switch-input" type="checkbox" name="heaterSwitch" {{ $checked }}>
					<label class="switch-paddle" for="heaterSwitch">
						<span class="show-for-sr">Heater Control</span>
					</label>
				</div>
			</div>

			<!-- Temperature slider -->
			<div class="contbox numbig" style="padding:25px 25px 0 25px;border:0px solid #000000;">
				<div class="rowbox" style="border:0px solid #000000;padding-left:60px">
					<div style="border:0px solid #000000;">
						<input type="text" id="sliderOutput" class="numbig" style="width:51px;border-width:0px;border:none;box-shadow: none;background: #222222;">
						<input type="hidden" id="heaterState" name="heaterState">
						<input type="hidden" id="heaterTemp" name="heaterTemp">
						<input type="hidden" id="currentTemp" name="currentTemp" value="{{ $last->temp }}">
					</div>
					<div style="border:0px solid #000000;padding-top:5px;">
						<span class="numbig">&#176;C</span>
					</div>
				</div>
				<div id="tempSlider" class="slider" data-slider data-initial-start="{{ $heaterTemp }}" data-step="1" data-options="start: 10; end: 30;precision:null;" style="border:0px solid #000000">
					<span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="sliderOutput"></span>
					<span class="slider-fill" data-slider-fill></span>
				</div>
			</div>
		</div>
		<div class="rowbox" style="padding:0 20px 35px  0;">
			<div class="contbox subtext">{{ trans('messages.control') }}</div>
			<div class="contbox subtext">{{ trans('messages.setTemp') }}</div>
		</div>
		<div class="rowbox" style="padding:20px 0  20px 0;">
			<!-- Submit -->
			<div class="contbox subtext">
				<button class="button" id="heaterSubmit" name="heaterSubmit" type="submit">{{ trans('messages.submit') }}</button>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	/**
     * Heater quickset
     */
    $("form[name='heater']").submit(function(event) {
        // Stop form from submitting normally
        event.preventDefault();

       // [Debug]
       //alert($(this).attr("id"));

	   // Set correct heaterBox value
		$("#heaterSwitch").is(':checked') 
			? $("#heaterState").val("0")
			: $("#heaterState").val("1");
			
		// Set correct heaterTemp value
		var tmp = $("#sliderOutput").val();
		$("#heaterTemp").val(tmp);

        // Get form elements values
        var values = $(this).serializeArray();

        ajaxRequest = $.ajax({
            url: "{{ route('heaterQuickSet.post') }}",
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
</script>