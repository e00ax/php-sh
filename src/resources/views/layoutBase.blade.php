<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Laravel Smarthome Frontend</title>

        <!-- Foundation styles -->
        <link href="{{ asset('/css/foundation.css') }}" rel="stylesheet">

        <!-- Smarthome stylesheets -->
        <link href="{{ asset('/css/sh.css') }}" media="all" rel="stylesheet">

        <!-- Spectrum stylesheets [deprecated]
        <link href="{{ asset('/css/spectrum.css') }}" rel="stylesheet">-->

        <!-- Side menu bar styles -->
        <link rel="stylesheet" media="all" href="{{ asset('/css/mobileSideNav.css') }}" />

        <!-- Inline styles -->
        <style></style>

        <!-- Foundation js stuff -->
        <script src="{{ asset('js/vendor/jquery.js') }}"></script>
        <script src="{{ asset('js/vendor/foundation.js') }}"></script>
        
        <!-- Get Canvas.js for graphical stats -->
        <script src="{{ asset('js/vendor/jquery.canvasjs.min.js') }}"></script>

        <!-- Get tween for apple like menu [deprecated]
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>-->

        <!-- Spectrum js [deprecated]
        <script src="{{ asset('js/spectrum.js') }}"></script>-->
        

        <!-- Browser detection 
        <script src="{{ asset('js/browser_detect.js') }}"></script>
        -->

        <!-- Inline javascript -->
        <script>	
            /**
             * On page load
             *
             */
            $(document).ready(function() {
                // Call Foundation
                $(document).foundation();
            });


            /**
             * Accordion menu
             *
             */
            $(document).on('click', '.accordionNavi', function(event) {
                // Only toggle menu if there is a panel to show
                if ($(this).next().attr('class') == 'accordionPanel') {
                    var panel = $(this).next();

                    // Collapse menu
                    if (panel.height()) {
                        panel.height(0);

                        // Change background color
                        $(this).css("background-color","#222");

                    // Expand menu
                    } else {
                        // Collapse all other panels too
                        $(".accordionPanel").each(function() {
                            $(this).height(0);
                        });

                        // Change all other panels color
                        $(".accordionNavi").each(function() {
                            $(this).css("background-color","#222");
                        });

                        // Change background color
                        $(this).css("background-color","#ccc");

                        // Set height to calculated scroll height
                        panel.height($(this).next().prop('scrollHeight'));
                    }
                }
            });
        </script>
    </head>

    <!-- PHP header -->
    @php
        //
    @endphp

    <body>
        <div class="colbox">
            <!-- Navigation -->
            @yield("menu")

            <!-- Temp/Hum Header -->
            @yield("header")

	        <div class="bodyBox">
                <div>
                    <!-- Left Body -->
                    @yield("bodyLeft")

                    <!-- Left lower Body -->
                    @yield("bodyLeftLower")
                </div>
                
                <!-- Right Body -->
                @yield("bodyRight")
            </div>
        </div>
    </body>
</html>