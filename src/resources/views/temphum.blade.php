<div class="box topHeader">
	<div class="rowbox headbox headline">
		<div style="border:0px solid white;padding:2px 0 0 5px;">&nbsp;</div>
		<div style="width:98%;border:0px solid white">{{ trans('messages.livingRoom') }}</div>
	</div>

	<form action="{{ url('temphum.post') }}" method="post" id="temphum" name="temphum">

		<!-- Content -->
		<div class="rowbox" style="border:0px solid white;padding:15px 0 20px 0;">
			<!-- Temperature -->
			<div style="border:0px solid white;width: 50%">
				<div>
					<a href="{{ url('pagination') }}" class="numbig">{{ round($last->temp, 1) }}&nbsp;&#176;C</a>
					<!--<button type="button" data-open="modal_temp" class="numbig" id="temp" name="temp">{{ round($last->temp, 1) }}&nbsp;&#176;C</button>-->
				</div>
				<div class="subtext">{{ trans('messages.temperature') }}</div>
			</div>

			<!-- Humidity -->
			<div style="border:0px solid white;width: 50%">
				<div>
					<a href="{{ url('pagination') }}" class="numbig">{{ round($last->hum, 1) }}&nbsp;%</a>
					<!--<button type="button" data-open="modal_hum" class="numbig" id="hum" name="hum">{{ round($last->hum, 1) }}&nbsp;%</button>-->
				</div>
				<div class="subtext">{{ trans('messages.humidity') }}</div>
			</div>
		</div>

	</form>

</div>

<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

</script>