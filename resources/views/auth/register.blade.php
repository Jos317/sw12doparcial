<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Diagramador JFCL | Registro</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content name="description" />
    <meta content name="author" />

    <link href="{{asset('asset/css/vendor.min.css')}}" rel="stylesheet" />
    <link href="{{asset('asset/css/apple/app.min.css')}}" rel="stylesheet" />
    <script src="{{asset('asset/plugins/ionicons/dist/ionicons/ionicons.js')}}"></script>

</head>

<body class="pace-top">

    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>


    <div id="app" class="app">

        <div class="register register-with-news-feed">

            <div class="news-feed">
                <div class="news-image" style="background-image: url({{asset('asset/img/login-bg/diagramador.jpg')}})"></div>
                <div class="news-caption">
                    <h4 class="caption-title"><b>DiagramadorJFCL</b></h4>
                    <p>
                        Diagramador para permitir a cualquier desarrollador, junto a su equipo que pueda gestionar sus diagramadas y que trabajen de forma simultánea en un mismo diagrama.
                    </p>
                </div>
            </div>


            <div class="register-container">

                <div class="register-header mb-25px h1">
                    <div class="mb-1">Registrar</div>
                    <small class="d-block fs-15px lh-16">Crea tu cuenta. Es gratis para todos</small>
                </div>


                <div class="register-content">
                    <form action="index.html" method="GET" class="fs-13px">
                        <div class="mb-3">
                            <label class="mb-2">Nombre <span class="text-danger">*</span></label>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <input type="text" class="form-control fs-13px" placeholder="First name" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control fs-13px" placeholder="Last name" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control fs-13px" placeholder="Email address" />
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Reescribe Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control fs-13px" placeholder="Re-enter email address" />
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Contraseña <span class="text-danger">*</span></label>
                            <input type="password" class="form-control fs-13px" placeholder="Password" />
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary d-block w-100 btn-lg h-45px fs-13px">Registrar</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>


        <a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top"
            data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

    </div>

    <script src="{{asset('asset/js/vendor.min.js')}}"></script>
    <script src="{{asset('asset/js/app.min.js')}}"></script>


    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3Q0VGQKY3"></script>
    {{-- <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
        integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
        data-cf-beacon='{"rayId":"7da45d971a67b3d4","version":"2023.4.0","r":1,"token":"4db8c6ef997743fda032d4f73cfeff63","si":100}'
        crossorigin="anonymous"></script> --}}
</body>

</html>
