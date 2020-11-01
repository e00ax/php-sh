@php
//echo "<pre>";
//print_r($rules);
//echo "</pre>";
@endphp

<div class="colbox box topHeader">
    <!-- Header -->
    <div class="rowbox headbox headline">
        <div style="width: 100%;text-align: center;">{{ trans('messages.rulesHeader') }}</div>
        <div style="text-align: right;padding-right: 10px;">
            <a href="{{ route('home') }}">
                <img id="back" src="{{ asset('img/arrowGrey.png') }}" style="width: 20px;border: 0;">
            </a>
        </div>
    </div>

    <div class="contbox" style="padding: 10px;">
        <!-- Accordion -->
        <div class="row foundation">
            <div class="columns">
                <ul class="accordion" data-accordion data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge-delay="500" id="deeplinked-accordion">
                    @foreach ($rules as $i => $rule) 
                        @php 
                            $i == array_key_first($rules) 
                                ? $active="active" 
                                : $active="" ;
                        @endphp

                    <!-- Accordion content -->
                    <li class="accordion-item {{ $active }}" data-accordion-item id="accHeader{{ $i }}">
                        <a href="#deeplink{{ $i }}" class="accordion-title">{{ $rules[$i]['name'] }}</a>
                        <div id="deeplink{{ $i }}" class="accordion-content" data-tab-content style="background: #222;">
                            <div class="colbox" style="background: #f8f9fa;border:1px solid #c4cad1;padding: 10px;border-radius: 5px;border-top:0px;text-align: left;">
                                <ul class="tabs" data-active-collapse="true" data-tabs id="hueTabs{{ $i }}">
                                    <li class="tabs-title is-active"><a href="#tabInfo{{ $i }}" aria-selected="true">{{ trans('messages.tabLightsInfo') }}</a></li>
                                    <li class="tabs-title"><a href="#tabUpdate{{ $i }}">{{ trans('messages.tabRulesUpdate') }}</a></li>
                                </ul>

                                <div class="tabs-content" data-tabs-content="hueTabs{{ $i }}">
                                    <div class="tabs-panel is-active" id="tabInfo{{ $i }}">
                                        @include('hue.rules.rulesLayoutTabInfo')
                                    </div>
                                    <div class="tabs-panel" id="tabRename{{ $i }}">
                                        @include('hue.rules.rulesLayoutTabUpdate')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

</script>