<div id="menu" class="topHeader">
    <header>
        <div class="row container">
            <div class="col-6" style="border: 0px solid white;">
                <div class="menu">
                    <a href="#">
                        <span>Menu</span>
                    </a>
                </div>
            </div>

            <!-- In case we are using no auth at all -->
            @php if (isset($_SERVER['REMOTE_USER'])) { @endphp
                <div style="border: 0px solid white;text-align: right;padding: 7px 20px 0 0;">
                    <span class="foundationWhite">Login:&nbsp;{{ $_SERVER['REMOTE_USER'] }}</span>
                </div>
            @php } @endphp
        </div>
    </header>
</div>

<!-- Side nav -->
<div id="mySidenav" class="sidenav">
    <!--<div>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    </div>-->
    
    <div id="navi" style="width: 150px;">
        <!-- @home -->
        <div class="accordionNavi" style="margin-top:0px;">
            @if (\Request::is('/'))
                <a href="{{ route('home') }}"><img src="{{ asset('img/home_on.png') }}" border="0" style="width: 100px;"></a>
            @else
                <a href="{{ route('home') }}"><img src="{{ asset('img/home.png') }}" border="0" style="width: 100px;"></a>
            @endif
        </div>

        <!-- @door -->
        <div class="accordionNavi">
            @if (\Request::is('door'))
                <a href="{{ route('door.get') }}"><img src="{{ asset('img/doorOn.png') }}" border="0" style="width: 100px;"></a>
            @else
                <a href="{{ route('door.get') }}"><img src="{{ asset('img/doorOff.png') }}" border="0" style="width: 100px;"></a>
            @endif
        </div>

        <!-- @heater -->
        <div class="accordionNavi">
            @if (\Request::is('heater/cycles', 'heater/mode'))
                <img src="{{ asset('img/heatOn.png') }}" border="0" style="width: 100px;">
            @else
                <img src="{{ asset('img/heatOff.png') }}" border="0" style="width: 100px;">
            @endif
        </div>
        <div class="accordionPanel">
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('heaterMode.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviMode') }}</a>
            </div>
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('heaterCycles.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviCycles') }}</a>
            </div>
        </div>

        <!-- @lights -->
        <div class="accordionNavi">
            @if (\Request::is('hue/lights', 'hue/lights/search', 'hue/lights/delete'))
                <img src="{{ asset('img/hueMenuOff.png') }}" border="0" style="width: 100px;">
            @else
                <img src="{{ asset('img/hueMenuOff.png') }}" border="0" style="width: 100px;">
            @endif
        </div>
        <div class="accordionPanel">
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('hueLights.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviLights') }}</a>
            </div>
            <div style="padding:5px 10px;border:1px solid #ccc;border-bottom: 0">
                <a href="{{ route('hueLightsSearch.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviSearch') }}</a>
            </div>
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('hueLightsDelete.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviDelete') }}</a>
            </div>
        </div>


        <!-- @groups -->
        <div class="accordionNavi">
            @if (\Request::is('hue/groups', 'hue/groups/create', 'hue/groups/delete'))
                <img src="{{ asset('img/zoneOff.png') }}" border="0" style="width: 100px;">
            @else
                <img src="{{ asset('img/zoneOff.png') }}" border="0" style="width: 100px;">
            @endif
        </div>
        <div class="accordionPanel">
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('hueGroups.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviGroups') }}</a>
            </div>
            <div style="padding:5px 10px;border:1px solid #ccc;border-bottom: 0">
                <a href="{{ route('hueGroupsCreate.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviCreate') }}</a>
            </div>
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('hueGroupsDelete.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviDelete') }}</a>
            </div>
        </div>


        <!-- @sensors -->
        <div class="accordionNavi">
            @if (\Request::is('hue/sensors', 'hue/sensors/search', 'hue/sensors/delete'))
                <img src="{{ asset('img/sensorsOff.png') }}" border="0" style="width: 100px;">
            @else
                <img src="{{ asset('img/sensorsOff.png') }}" border="0" style="width: 100px;">
            @endif
        </div>
        <div class="accordionPanel">
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('hueSensors.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviSensors') }}</a>
            </div>
            <div style="padding:5px 10px;border:1px solid #ccc;border-bottom: 0">
                <a href="{{ route('hueSensorsSearch.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviSearch') }}</a>
            </div>
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('hueSensorsDelete.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviDelete') }}</a>
            </div>
        </div>


        <!-- @rules -->
        <div class="accordionNavi">
            @if (\Request::is('hue/rules'))
                <img src="{{ asset('img/rulesOff.png') }}" border="0" style="width: 100px;">
            @else
                <img src="{{ asset('img/rulesOff.png') }}" border="0" style="width: 100px;">
            @endif
        </div>
        <div class="accordionPanel">
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('hueRules.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviRules') }}</a>
            </div>
            <div style="padding:5px 10px;border:1px solid #ccc;border-bottom: 0">
                <a href="{{ route('hueRulesCreate.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviCreate') }}</a>
            </div>
            <div style="padding:5px 10px;border:1px solid #ccc;">
                <a href="{{ route('hueRulesDelete.get') }}" class="subtext" style="text-decoration:none;">&rarr;&nbsp;{{ trans('messages.naviDelete') }}</a>
            </div>
        </div>

        <!-- Settings 
        <div class="accordion">
            <img src="{{ asset('img/settings.png') }}" border="0" />
        </div>-->
    </div>
</div>

<script type="text/javascript">
    /**
	 * Toggle menu
     *
	 */
    var isOpen = 0;
    $(document).on('click', '.menu a', function(event) {
        if (isOpen == 0) {
            // Toggle
            $(this).toggleClass('active');
            isOpen++;

            // Change attributes
            $("#mySidenav").width('150px');
            $("#main").css({marginLeft:'150px'});
            //$("body").css("background-color","#333");
        } else {
            // Toggle
            $(this).toggleClass('active');
            isOpen--;

            // Change attributes
            $("#mySidenav").width('0');
            $("#main").css({marginLeft:'0'});
            //$("body").css("background-color","#000");
        } 
    });
</script>