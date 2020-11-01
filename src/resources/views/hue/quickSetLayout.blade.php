@php
//dd($lights);
@endphp

<!-- Hue lights quickset -->
<div class="box quicksetHeader quicksetHeaderFlex">
	<div class="headbox headline">Philips Hue</div>
	
	<!-- Accordion -->
	<div class="row foundation">
        <div class="columns">
            <ul class="accordion" data-accordion style="text-align: left;">
				
				<!-- Lights -->
				<li class="accordion-item" data-accordion-item>
					<a href="#" class="accordion-title" style="background: #222;border: 0px;">
						<!--<img src="img/lightsMini.png" style="border:0px;width: 60px;">-->
						<span>>&nbsp;Lights</span>
					</a>
                    
					<!-- Lights -->
					<div class="accordion-content" data-tab-content style="background: #222;border: 0px;">
						<div class="colbox" style="background: #222;border: 0px solid #3e3e3e;padding: 10px 10px 0 10px;border-radius: 5px;">
							<div>
								<table class="hover foundation">
									<!--<thead style="background: #e1e1e1;">
										<tr>
											<th>Option</th>
											<th>Value</th>
											<th>Value</th>
										</tr>
									</thead>-->
									<tbody style="border: 0px;">
										@foreach ($lights as $i => $light)
											@php
												if ($lights[$i]['state']['on'] == true) {
													$checked = "checked";
													$img = "on";
												}else {
													$checked = "";
													$img = "off";
												}
											@endphp
											<tr style="background: #222;">
												<td><img id="lights{{ $i }}Img" src="img/hue{{ $img }}.png" style="border:0px;width: 30px;"></td>
												<td><a href="{{ url('/hue/lights#deeplink'.$i) }}" >{{ $lights[$i]['name'] }}</a></td>
												<td>
													<!-- Checkbox -->
													<!-- TODO: Use Reveal to submit values! -->
													<div class="contbox subtext" style="padding-top:10px;">
														<div id="hue" class="switch radius">
															<input id="lights#{{ $i }}" class="switch-input" type="checkbox" name="lights#{{ $i }}" {{ $checked }}>
															<label class="switch-paddle" for="lights#{{ $i }}">
																<span class="show-for-sr">Light Control</span>
															</label>
														</div>
													</div>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</li>
				
				<!-- Groups -->
				<li class="accordion-item is-active" data-accordion-item>
					<a href="#" class="accordion-title" style="background: #222;border: 0px;">
						<!--<img src="img/zoneMini.png" style="border:0px;width: 60px;">-->
						<span>>&nbsp;Groups</span>
					</a>
					<div class="accordion-content" data-tab-content style="background: #222;border: 0px;">
						<div class="colbox" style="background: #222;border: 0px solid #3e3e3e;padding: 10px 10px 0 10px;border-radius: 5px;">
							<table class="hover foundation">
								<tbody style="border: 0px;">
									@foreach ($groups as $i => $group)
										@php
											if ($groups[$i]['action']['on'] == true) {
												$checked = "checked";
												$img = "on";
											}else {
												$checked = "";
												$img = "off";
											}
										@endphp
										<tr style="background: #222;">
											<td>
												<img id="groups{{ $i }}Img" src="img/hue{{ $img }}.png" style="border:0px;width: 30px;">
											</td>
											<td>
												<a href="{{ url('/hue/groups#deeplink'.$i) }}" >{{ $groups[$i]['name'] }}<br>[{{ $groups[$i]['type'] }}]</a>
											</td>
											<td>
												<!-- Checkbox -->
												<!-- TODO: Use Reveal to submit values! -->
												<div class="contbox subtext" style="padding-top:10px;">
													<div id="hue" class="switch radius">
														<input id="groups#{{ $i }}" class="switch-input" type="checkbox" name="groups#{{ $i }}" {{ $checked }}>
														<label class="switch-paddle" for="groups#{{ $i }}">
															<span class="show-for-sr">Group Control</span>
														</label>
													</div>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>


<script type="text/javascript">
	/**
	 * Send hue quickset ajax data
	 */
	$('#hue input[type=checkbox]').click(function(){
		var split = $(this).attr("id").split("#");
		var name = split[0];
        var id = split[1];
		var state = '';
		var url = '';

		// [Debug]
        //alert($(this).attr("id"));

		if (split[0] == 'lights') {
			url = "{{ route('hueQuickSet.post') }}";
		}

		if (split[0] == 'groups') {
			url = "{{ route('hueGroupsQuickSet.post') }}";
		}
				
		// Switch is checked
		if ($(this).is(':checked')) {
			state = 1;
			$("#" + name + id + "Img").attr("src", "img/hueon.png");
					
			// [Debug]
			//alert(state);
					
		// Switch is unchecked
		}else {
			state = 0;
			$("#" + name + id + "Img").attr("src", "img/hueoff.png");
				
			// [Debug]
			//alert(state);
		}
				
		// Create post object
		var values = {
			id: id,
			state: state
		};
		
		ajaxRequest = $.ajax({
			url: url,
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