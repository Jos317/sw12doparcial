<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>JFCL</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/svg" href="{{asset('asset/img/class.png')}}">

        <link rel="stylesheet" href="{{ asset('css/rappid.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/theme-picker.css') }}">

        <link rel="stylesheet" href="{{ asset('css/style.dark.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.material.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.modern.css') }}">

        <link href="{{asset('asset/css/vendor.min.css')}}" rel="stylesheet"/>
        <link href="{{asset('asset/css/apple/app.min.css')}}" rel="stylesheet"/>
        <link href="{{asset('asset/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet"/>
        <link href="{{asset('asset/plugins/jvectormap-next/jquery-jvectormap.css')}}" rel="stylesheet"/>
        <link href="{{asset('asset/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}" rel="stylesheet"/>
        <link href="{{asset('asset/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet"/>

        
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
        

        <style>
            .file-upload-btn {
                width: 100%;
                margin: 5px;
                color: #fff;
                background: #1FB264;
                border: none;
                padding: 10px;
                border-radius: 4px;
                border-bottom: 4px solid #15824B;
                transition: all .2s ease;
                outline: none;
                text-transform: uppercase;
                font-weight: 700;
            }
    
            .file-upload-btn:hover {
                background: #1AA059;
                color: #ffffff;
                transition: all .2s ease;
                cursor: pointer;
            }
    
            .file-upload-btn:active {
                border: 0;
                transition: all .2s ease;
            }
    
            .file-upload-content {
                display: none;
                text-align: center;
            }
    
            .file-upload-input {
                position: absolute;
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                outline: none;
                opacity: 0;
                cursor: pointer;
            }
    
            .image-upload-wrap {
                margin-top: 20px;
                border: 4px dashed #757580;
                position: relative;
            }
    
            .image-dropping,
            .image-upload-wrap:hover {
                background-color: #e9e9f3;
                border: 4px dashed #757580;
            }
    
            .image-title-wrap {
                padding: 0 15px 15px 15px;
                color: #222;
            }
    
            .drag-text {
                text-align: center;
            }
    
            .drag-text h3 {
                font-weight: 100;
                /* text-transform: uppercase; */
                color: #000000;
                padding: 60px 0;
            }
    
            .file-upload-image {
                max-height: 200px;
                max-width: 200px;
                margin: auto;
                padding: 20px;
            }
    
            .remove-image {
                width: 200px;
                margin: 0;
                color: #fff;
                background: #cd4535;
                border: none;
                padding: 10px;
                border-radius: 4px;
                border-bottom: 4px solid #b02818;
                transition: all .2s ease;
                outline: none;
                text-transform: uppercase;
                font-weight: 700;
            }
    
            .remove-image:hover {
                background: #c13b2a;
                color: #ffffff;
                transition: all .2s ease;
                cursor: pointer;
            }
    
            .remove-image:active {
                border: 0;
                transition: all .2s ease;
            }
        </style>
    </head>
    <body>

        {{-- <div id="loader" class="app-loader">
            <span class="spinner"></span>
        </div> --}}

        <div id="app" class="app app-header-fixed app-sidebar-fixed ">

            @include('layouts.headerPrincipal')

            @include('layouts.sidebarPrincipal')

            <div class="app-sidebar-bg"></div>
            <div class="app-sidebar-mobile-backdrop">
                <a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a>
            </div>

            <div id="content" class="app-content">
                @yield('content')
            </div>

            @include('layouts.temasPrincipal')

            <a
                href="javascript:;"
                class="btn btn-icon btn-circle btn-primary btn-scroll-to-top"
                data-toggle="scroll-to-top">
                <i class="fa fa-angle-up"></i>
            </a>

        </div>

        <script src="{{asset('asset/js/vendor.min.js')}}"></script>
        <script src="{{asset('asset/js/app.min.js')}}"></script>
        <script src="{{asset('asset/plugins/ionicons/dist/ionicons/ionicons.js')}}"></script>

        {{-- <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{asset('/js/app.js')}}"></script> --}}

        <script src="{{asset('asset/plugins/gritter/js/jquery.gritter.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.canvaswrapper.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.colorhelpers.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.saturated.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.browser.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.drawSeries.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.uiConstants.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.time.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.resize.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.pie.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.crosshair.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.categories.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.navigate.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.touchNavigate.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.hover.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.touch.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.selection.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.symbol.js')}}"></script>
        <script src="{{asset('asset/plugins/flot/source/jquery.flot.legend.js')}}"></script>
        <script src="{{asset('asset/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <script src="{{asset('asset/plugins/jvectormap-next/jquery-jvectormap.min.js')}}"></script>
        <script src="{{asset('asset/plugins/jvectormap-next/jquery-jvectormap-world-mill.js')}}"></script>
        <script src="{{asset('asset/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('asset/js/demo/dashboard.js')}}"></script>

        {{-- <script src="{{asset('asset/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')}}"></script>
        <script src="{{asset('asset/ajax/libs/moment.js/2.18.1/moment.min.js')}}"></script>
        <script src="{{asset('asset/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js')}}"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if(Session::has('message'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.success("{{ session('message') }}");
            @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.error("{{ session('error') }}");
            @endif

            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.info("{{ session('info') }}");
            @endif

            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.warning("{{ session('warning') }}");
            @endif
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.js'></script>
        <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script> --}}
        {{-- <script>
            var usuario = @json($usuario);
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
        
            var pusher = new Pusher('72febab278198d502232', {
                cluster: 'us2'
            });
        
            var channel = pusher.subscribe('my-channel');
            channel.bind(`my-event_user_${usuario.id}`, function(data) {
                // alert(JSON.stringify(data));
                $('#contador_notificacion').show();
                handleDashboardGritterNotification(
                    'Nueva consulta!!', 
                    `Se ha agendado una nueva consulta el ${data[0].inicio} por el paciente: ${data[0].paciente.nombre} ${data[0].paciente.apellido}`, 
                    `/${data[0].paciente.imagen}`
                );

                if( $('#calendar').length )         // use this if you are using id to check
                {
                    // $('#calendar').html('');

                    $.ajax({
                        type: "GET",
                        url: "{{url('dashboard')}}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            console.log(response.events);
                            $("#calendar").fullCalendar('removeEvents'); 
                            $("#calendar").fullCalendar('addEventSource', response.events); 
                        },
                        error: function (jqXHR, textStatus, errorThrown ) {
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(errorThrown );
                        }
                    });
                }
            });

            var handleDashboardGritterNotification = function (title, text, image) {
                setTimeout(function () {
                    $
                        .gritter
                        .add({
                            title: title,
                            text: text,
                            image: image,
                            sticky: true,
                            time: '',
                            class_name: 'my-sticky-class'
                        });
                }, 1000);
            };

            document.addEventListener("click", someListener );

            function someListener(event){
                var element = event.target;
                if(element.classList.contains("gritter-item") || element.classList.contains("gritter-title") || element.classList.contains("gritter-image")){
                    $('#contador_notificacion').hide();
                    window.location.replace("consultas");
                }
            }
        </script> --}}
        @stack('scripts')

        {{-- <script src="{{asset('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"></script> --}}
    </body>
</html>