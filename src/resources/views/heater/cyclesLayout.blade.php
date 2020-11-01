<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.cycles') }}</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>

    <form action="{{ route('heaterCycles.get') }}" method="post" id="heaterFullset" name="heaterFullset">

        <!-- Content -->
        <div class="contbox" style="padding: 10px;">
            <!-- Accordion -->
            <div class="row foundation">
                <div class="columns">
                    <ul class="accordion" data-accordion>
                        @php
                            $i = 0;

                            //dd($iniFile);
                        @endphp


                        @foreach ($iniFile['auto'] as $days => $data)
                            @php
                                $i++;
                                $n = 0;

                                // Get cycles as array
                                $cycles = explode("#", $data);

                                $i==1 ? $active="active" : $active="" ;
                            @endphp

                        <li class="accordion-item {{ $active }}" data-accordion-item>
                            <a href="#" class="accordion-title">{{ $days }}</a>
                            <div class="accordion-content" id="heaterContent{{ $i }}" data-tab-content style="background: #222;">
                                @foreach ($cycles as $times)
                                    @php
                                        $n++;

                                        // Split cycles
                                        $data = explode("-", $times);
                                        $start_time = explode(":", $data[0]);
                                        $end_time = explode(":", $data[1]);
                                        $temp = $data[2];
                                    @endphp
                                <div class="colbox" id="testNode{{ $i.$n }}">
                                <!-- Heater cycles per week -->
                                <div class="rowbox" id="heaterCycleNode{{ $i.$n }}" style="background: #f8f9fa;border:1px solid #c4cad1;border-radius: 5px;">
                                    <!-- Count     
                                    <div style="border: 0px solid #000;padding: 15px 0 0 5px;">[{{ $i.$n }}]</div>-->

                                    <!-- Add -->
                                    <div class="subtext" style="width: 55px;border: 0px solid #000;padding: 12px 5px 0 0;">
                                        <a><img id="add{{ $i.$n }}" src="../img/add.png" border="0" style="width: 30px;"></a>
                                    </div>

                                    <!-- Delete -->
                                    <div style="width: 55px;border: 0px solid #000;padding: 12px 5px 0 0;">
                                        <a><img id="del{{ $i.$n }}" src="../img/del.png" border="0" style="width: 30px;"></a>
                                    </div>

                                    <div style="width: 75px;border: 0px solid #000;text-align: right;padding: 16px 5px 0 0;">{{ trans('messages.from') }}:</div>

                                    <!-- Start hours -->
                                    <div style="width:75px;border:0px solid #000;padding-top: 7px;">
                                        <select class="subtext sel" id="startHours{{ $i.$n }}" name="startHours{{ $i.$n }}" style="border-right: 0px;">
                                            @for ($a = 0; $a < 24; $a++) 
                                                @php 
                                                    $hour=sprintf("%02d", $a); 
                                                    $start_time[0]==$hour 
                                                        ? $sel='SELECTED' 
                                                        : $sel='' ; 
                                                @endphp 
                                                <option value="{{ $hour }}" {{ $sel }}>{{ $hour }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Start minutes -->
                                    <div style="width:75px;border:0px solid #000;padding-top: 7px;">
                                        <select class="subtext sel" id="startMinutes{{ $i.$n }}" name="startMinutes{{ $i.$n }}">
                                            @for ($a = 0; $a < 60; $a++) 
                                                @php 
                                                    $minute=sprintf("%02d", $a); 
                                                    $start_time[1]==$minute 
                                                        ? $sel='SELECTED' 
                                                        : $sel='' ; 
                                                @endphp 
                                                <option value="{{ $minute }}" {{ $sel }}>{{ $minute }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div style="width:75px;border:0px solid #000;text-align:right;padding:16px 5px 0 0;">{{ trans('messages.to') }}:</div>

                                    <!-- End hours -->
                                    <div style="width:75px;border:0px solid #000;padding-top: 7px;">
                                        <select class="subtext sel" id="endHours{{ $i.$n }}" name="endHours{{ $i.$n }}" style="border-right: 0px;">
                                            @for ($a = 0; $a < 60; $a++) 
                                                @php 
                                                    $hour=sprintf("%02d", $a); 
                                                    $end_time[0]==$hour 
                                                        ? $sel='SELECTED' 
                                                        : $sel='' ; 
                                                @endphp 
                                                <option value="{{ $hour }}" {{ $sel }}>{{ $hour }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- End minutes -->
                                    <div style="width:75px;border:0px solid #000;padding-top: 7px;">
                                        <select class="subtext sel" id="endMinutes{{ $i.$n }}" name="endMinutes{{ $i.$n }}">
                                            @for ($a = 0; $a < 60; $a++) 
                                                @php 
                                                    $minute=sprintf("%02d", $a); 
                                                    $end_time[1]==$minute 
                                                        ? $sel='SELECTED' 
                                                        : $sel='' ; 
                                                @endphp 
                                                <option value="{{ $minute }}" {{ $sel }}>{{ $minute }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div style="width:190px;border:0px solid #000;text-align:right;padding:16px 5px 0 0;">{{ trans('messages.temperature') }}:</div>

                                    <!-- Temperature -->
                                    <div style="width:85px;border:0px solid #000;padding: 7px 10px 0 0;">
                                        <select class="subtext sel" id="temp{{ $i.$n }}" name="temp{{ $i.$n }}">
                                            @for ($a = 10; $a <= 30; $a++) 
                                                @php
                                                    $temp == $a 
                                                        ? $sel='SELECTED' 
                                                        : $sel='' ; 
                                                @endphp 
                                                <option value="{{ $a }}" {{ $sel }}>{{ $a }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                </div>
                                @endforeach

                                <!-- Add cycle 
                                <div class="subtext" style="border: 0px solid #000;width:125px;padding:25px 0 10px 42px;text-align: left;">
                                    <a><img id="add{{ $i.$n }}" src="img/add.png" border="0"></a>
                                </div>-->
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Hidden stuff -->
        <input type="hidden" id="manual" name="manual" value="{{ $iniFile['manual']['temp'] }}">
        <input type="hidden" id="heaterAuto" name="heaterAuto">

        <!-- Save Weekly Cycle  -->
		<div class="subtext" style="border: 0px solid #000;width:125px;padding-bottom: 15px;">
			<input type="submit" class="button" id="heaterFullsetSubmit" name="heaterFullsetSubmit" value="{{ trans('messages.save') }}">
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
     * Write heater data to ini file
     *
     */
    $("#heaterFullset").submit(function(event) {
        // Stop form from submitting normally
	    event.preventDefault();

        // Get form elements values
	    var values = $(this).serialize();
	  		
        ajaxCall("{{ route('heaterCycles.post') }}", "POST", values);
    });


    /**
     * [add|del] Heater cycle element node
     *
     */
	$("#heaterFullset").find('img').click(function(){
		// Field tyle [add|del]
		var imgtype = $(this).attr("id").substr(0, 3);
		
		// Day number [1-7]
		var daynum = $(this).attr("id").substr(3, 1);
		
		// Internal lineid [1,2...9]
		var rowid = $(this).attr("id").substr(4);
		
		// [debug]
		//alert(rowid);
		
		
		/*
		 * Add new heater cycle node
		 */
		if (imgtype == 'add') {
			// Maximum number of cycles
			var maxid = 9;
			
			// Array with field id numbers
			var ids = [];
			var rowids, newid, count;

            // [debug]
			//alert(rowid);
			
			// Loop over img fields and collect ids
			$("#heaterContent"+daynum+" img").each(function(){
			 	// Get rowid and store it in ids
                if ($(this).attr("id") == 'add'+daynum+rowid) {
                    rowids = $(this).attr("id").substr(4);
                    ids.push(rowids);
                }
                
                // [debug]
			 	//alert(rowids);
			});
			
			// Check for maximum number of rows (9)
			count = ids.length;
			if (count >= maxid) {
				alert('Too many cycles!');
				
			// Proceed to clone the cycle node
			} else {
				// Check for a new id  which is not used
				for (var i = 1; i <= maxid; i++) {
					// Cast i to tring because of substr above
					var a = i.toString();
					
					// Set a new id wich is not given
					if ($.inArray(a, ids) == -1) {
						newid = a;
						
						// [debug]
						//alert(a);
						break;
					}
				}
				
				/*
                 * Clone the cycle node
                 * 
				 */
				$("#heaterCycleNode"+daynum+rowid).clone(true).appendTo("#testNode"+daynum+rowid).prop('id', 'heaterCycleNode'+daynum+newid );
				
				// Change img id of cloned node, so we can delete the row later again
				$("#heaterCycleNode"+daynum+newid+" img").each(function(){
					if ($(this).attr("id") == 'add'+daynum+rowid) {
                        $(this).attr("id", 'add'+daynum+newid);

                        // [debug]
					    //alert($(this).attr("id"));
                    }
                    
                    if ($(this).attr("id") == 'del'+daynum+rowid) {
                        $(this).attr("id", 'del'+daynum+newid);

                        // [debug]
					    //alert($(this).attr("id"));
                    }
				});
				
                // Change select field ids
                // TODO: Change name identifier to id in select fields. clone actual values instead of basic clones!
				$("#heaterCycleNode"+daynum+newid+" select").each(function(){
					if ($(this).attr("id") == 'startMinutes'+daynum+rowid) {
                        $(this).attr("id", 'startMinutes'+daynum+newid);
                        
                        // Start with blank values
                        //$('#startMinutes'+daynum+newid).val("00");
                        
						// [debug]
						//alert($(this).attr("id"));
					}
						
					if ($(this).attr("id") == 'startHours'+daynum+rowid) {
                        $(this).attr("id", 'startHours'+daynum+newid);
                        
                        // Start with blank values
                        //$('#startHours'+daynum+newid).val("00");

						// [debug]
						//alert($(this).attr("id"));
					}
						
					if ($(this).attr("id") == 'endMinutes'+daynum+rowid) {
                        $(this).attr("id", 'endMinutes'+daynum+newid);
                        
                        // Start with blank values
                        //$('#endMinutes'+daynum+newid).val("00");

						// [debug]
						//alert($(this).attr("id"));
					}
						
					if ($(this).attr("id") == 'endHours'+daynum+rowid) {
                        $(this).attr("id", 'endHours'+daynum+newid);
                        
                        // Start with blank values
                        //$('#endHours'+daynum+newid).val("00");

						// [debug]
						//alert($(this).attr("id"));
					}
					
					if ($(this).attr("id") == 'temp'+daynum+rowid) {
                        $(this).attr("id", 'temp'+daynum+newid);
                        
                        // Start with blank values
                        //$('#temp'+daynum+newid).val("20");
                        
						// [debug]
						//alert($(this).attr("id"));
					}
				});
                
			}
		}
		
		
		/*
		 * Delete heater cycle node
		 */
		if (imgtype == 'del') {
			// Get amount of rows
			var count = $( "#heaterContent"+daynum+" img").length;
			
			// We do not allow to clear the last rule
			if (count <= 2) {
				alert('Unable to remove the last node!');
			}else {
				$( "#heaterCycleNode"+daynum+rowid ).remove();
			}
			
			// [debug]
			//alert('del: #cycleNode'+daynum+rowid);
		}
		});
</script>