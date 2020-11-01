<form action="{{ route('nuki.post') }}" method="post" id="nuki" name="nuki">
    <div>
        <table class="hover foundation" style="text-align: center;">
            <tbody>
                <tr>
                    <td class="headlineTable">
                        <img src="img/doorFlatLock.png" style="border:0px;width: 60px;">
                    </td>
                    <td style="padding: 15px 25px 0 25px;text-align:">
                        <button type="button" data-open="modalNuki" class="button" id="lock" name="action" style="min-width: 100px;">{{ trans('messages.lock') }}</button>
                    </td>
                </tr>
                <tr>
                    <td class="headlineTable">
                        <img src="img/doorFlatUnlock.png" style="border:0px;width: 60px;">
                    </td>
                    <td style="padding: 15px 25px 0 25px;">
                        <button type="button" data-open="modalNuki" class="button" id="unlock" name="action" style="min-width: 100px;">{{ trans('messages.unlock') }}</button>
                    </td>
                </tr>
                <tr>
                    <td class="headlineTable">
                        <img src="img/frontDoorOn.png" style="border:0px;width: 60px;">
                    </td>
                    <td style="padding: 15px 25px 0 25px;">
                        <button type="button" data-open="modalNuki" class="button" id="unlatch" name="action" style="min-width: 100px;">{{ trans('messages.unlatch') }}</button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="reveal shModal" id="modalNuki" data-reveal style="padding-bottom:10px;color:#000;background: #ddd;">
                    <!-- Close -->
                    <button type="button" class="close-button" data-close aria-label="Close modal">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="rowbox" id="modalNukiHeader" style="padding:0 0 15px 0;">{{ trans('messages.header') }}?</div>
                    <div class="rowbox" style="padding:0;background: #171717;">
                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionHeader') }}:</div>
                        <div class="contbox numsmall" id="modalNukiAction" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.actionAppartmentDoor') }}</div>
                        
                        <!-- Hidden lock action field -->
                        <input type="hidden" id="action">
                    </div>
                    <div class="rowbox" style="padding:0;background: #171717;">
                        <div class="contbox subtext" style="width: 30%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">{{ trans('messages.responseHeader') }}:</div>
                        <div class="contbox numsmall" style="width: 70%;padding: 5px 5px 5px 15px;border: 1px solid #333;text-align: left;">
                            <pre id="modalNukiResponse" style="white-space: pre-wrap;">{{ trans('messages.response') }}</pre>
                        </div>
                    </div>

                    <!-- Submit modal -->
                    <div class="rowbox" style="padding:15px 0 0 0;">
                        <div style="width:50%;text-align:left;">
                            <button type="submit" class="button" id="modalNukiSubmit" name="modalNukiSubmit" style="width: 100px;">{{ trans('messages.submit') }}</button>
                        </div>
                    </div>
                </div>
            </tbody>
        </table>
    </div>
</form>

<script type="text/javascript">
    
</script>