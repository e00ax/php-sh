<form action="{{ route('hueSensorsRename.post') }}" method="post" id="hueSensorsRename{{ $i }}" name="hueSensorsRename">
    <div class="rowbox" style="background: #f8f9fa;border:1px solid #c4cad1;border-radius: 5px;">
        <div style="width: 10%;padding: 35px 25px 0 25px;border: 0px solid black;text-align: right;">Name:</div>
        <div style="width: 50%;border: 0px solid #000000;padding: 26px 0 0 10px;text-align: left;">
            <input type="text" id="hueSensorsName{{ $i }}" style="height: 40px;" value="{{ $sensors[$i]['name'] }}">
            <input type="hidden" id="hueSensorsId{{ $i }}" value="{{ $i }}">
        </div>

        <!-- Open modal -->
        <div class="rowbox" style="width: 40%;border: 0px solid #000000;padding: 26px 25px 0 0;text-align: right;">
            <input type="button" data-open="modalHueSensorsRename{{ $i }}" id="hueSensorsRenameSubmit{{ $i }}" class="button" style="background: #1779ba" value="Submit">
        </div>

        <!-- Modal -->
        <div class="reveal shModal" id="modalHueSensorsRename{{ $i }}" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
            <!-- Close -->
            <button class="close-button" id="modalHueSensorsRenameClose{{ $i }}" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="rowbox" id="modalHueSensorsRenameHeader{{ $i }}" style="padding:0 0 15px 0;">{{ trans('messages.header') }}?</div>
            <div class="rowbox" style="padding:0;background: #171717;">
                <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">Name:</div>
                <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ $sensors[$i]['name'] }}</div>
            </div>
            <div class="rowbox" style="padding:0;background: #171717;">
                <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionHeader') }}:</div>
                <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.sensorsActionRename') }}</div>
            </div>
            <div class="rowbox" style="padding:0;background: #171717;">
                <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.responseHeader') }}:</div>
                <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">
                    <pre id="modalHueSensorsRenameResponse{{ $i }}" style="white-space: pre-wrap;">{{ trans('messages.response') }}</pre>
                </div>
            </div>

            <!-- Submit -->
            <div class="rowbox" style="padding:15px 0 0 0;">
                <div style="width:50%;text-align:left;">
                    <button type="submit" class="button" id="modalHueSensorsRenameSubmit#{{ $i }}" name="modalHueSensorsRenameSubmit" style="width: 100px;">{{ trans('messages.submit') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    
</script>