<form action="{{ route('hueGroupsModify.post') }}" method="post" id="hueGroupsModify{{ $i }}" name="hueGroupsModify">
    <div class="colbox" style="background: #f8f9fa;border:1px solid #c4cad1;border-radius: 5px;">
        <!-- Name -->
        <div class="rowbox">
            <div style="width: 10%;padding: 35px 25px 0 25px;border: 0px solid black;text-align: right;">Name:</div>
            <div style="width: 50%;border: 0px solid #000000;padding: 26px 0 0 10px;text-align: left;">
                <input type="text" id="hueGroupsModifyName{{ $i }}" name="hueGroupsModifyName" value="{{ $groups[$i]['name'] }}">
                <input type="hidden" id="hueGroupsModifyId{{ $i }}" name="hueGroupsModifyId" value="{{ $i }}">
            </div>
        </div>

        <!-- Lights -->
        @foreach ($lights as $id => $light)
            @php
                in_array($id, $groups[$i]['lights'])
                    ? $checked = "checked"
                    : $checked = "";
            @endphp
            <div class="rowbox">
                <div style="width: 10%;padding: 15px 25px 0 25px;border: 0px solid black;text-align: left;">
                    <a href="{{ url('/hue/lights#deeplink'.$id) }}">{{ $lights[$id]['name'] }}</a>
                </div>

                <div class="contbox" style="padding-top:10px;">
                    <div class="switch radius">
                        <input id="hueGroupsModifySwitch#{{ $i.'#'.$id }}" class="switch-input" type="checkbox" name="hueGroupsModifySwitch#{{ $i.'#'.$id }}" {{ $checked }}>
                        <label class="switch-paddle" for="hueGroupsModifySwitch#{{ $i.'#'.$id }}">
                            <span class="show-for-sr">Light Control</span>
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Submit -->
    <div style="padding:15px 0 0 0;">
        <div style="width:50%;text-align:left;">
            <button type="button" data-open="modalHueGroupsModify{{ $i }}" class="button" id="hueGroupsModifySubmit{{ $i }}" name="hueGroupsModifySubmit" style="width: 100px;">{{ trans('messages.submit') }}</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="reveal shModal" id="modalHueGroupsModify{{ $i }}" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
        <!-- Close -->
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>

        <div class="rowbox" id="modalHueGroupsModifyHeader{{ $i }}" style="padding:0 0 15px 0;">{{ trans('messages.header') }}?</div>
        <div class="rowbox" style="padding:0;background: #171717;">
            <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">Name:</div>
            <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ $groups[$i]['name'] }}</div>
        </div>
        <div class="rowbox" style="padding:0;background: #171717;">
            <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionHeader') }}:</div>
            <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.groupsActionModify') }}</div>
        </div>
        <div class="rowbox" style="padding:0;background: #171717;">
            <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.responseHeader') }}:</div>
            <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">
                <pre id="modalHueGroupsModifyResponse{{ $i }}" style="white-space: pre-wrap;">{{ trans('messages.response') }}</pre>
            </div>
        </div>

        <!-- Submit modal -->
        <div class="rowbox" style="padding:15px 0 0 0;">
            <div style="width:50%;text-align:left;">
                <button type="submit" class="button" id="modalHueGroupsModifySubmit#{{ $i }}" name="modalHueGroupsModifySubmit" style="width: 100px;">{{ trans('messages.submit') }}</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    
</script>