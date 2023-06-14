<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Diagramador de clases</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content name="description" />
    <meta content name="author" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('asset/css/one-page-parallax/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset/css/one-page-parallax/app.min.css') }}" rel="stylesheet" />

</head>

<body data-bs-spy="scroll" data-bs-target="#header" data-bs-offset="51">

    <div id="page-container" class="fade">

        <div id="header" class="header navbar navbar-transparent navbar-fixed-top navbar-expand-lg">

            <div class="container">

                <a href="#" class="navbar-brand">
                    <span class="brand-logo"></span>
                    <span class="brand-text">
                        <span class="text-theme">Diagramador</span>
                    </span>
                </a>


                <button type="button" class="navbar-toggle collapsed" data-bs-toggle="collapse"
                    data-bs-target="#header-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link active" href="#home" data-click="scroll-to-target"
                                data-scroll-target="#home">HOME</a>

                        </li>
                        <li class="nav-item"><a class="nav-link" href="#service"
                                data-click="scroll-to-target">SERVICIOS</a></li>
                    </ul>
                </div>

            </div>

        </div>


        <div id="home" class="content has-bg home">

            <div class="content-bg" style="background-image: url({{ asset('/asset/img/bg/bg-home.jpg') }})"
                data-paroller="true" data-paroller-type="foreground" data-paroller-factor="-0.25">
            </div>


            <div class="container home-content">
                <h1>Diagramador de modelos de dominio</h1>
                <h3>Para desarrolladores de software</h3>
                <p>
                    Es una página para realizar diagramas de modelos de dominio basado en UML<br />
                    Es multiusuario y gratuito
                </p>
                <a href="{{url('login')}}" class="btn btn-theme btn-primary">Iniciar Sesión</a> 
                <a href="#" class="btn btn-theme btn-outline-white">Registrarse</a>
                <br />
                <br />
            </div>

        </div>

        <div id="service" class="content" data-scrollview="true">

            <div class="container">
                <h2 class="content-title">Nuestros Servicios</h2>

                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="service">
                            <div class="icon" data-animation="true" data-animation-type="animate__bounceIn"><i
                                    class="fa fa-cog"></i></div>
                            <div class="info">
                                <h4 class="title">Diseño ligero</h4>
                                <p class="desc">En tan sencillos pasos por el diseñó, comprendes a la perfección el funcionamiento total del sistema 
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6">
                        <div class="service">
                            <div class="icon" data-animation="true" data-animation-type="animate__bounceIn"><i
                                    class="fa fa-paint-brush"></i></div>
                            <div class="info">
                                <h4 class="title">Elaborar diagramas de clases</h4>
                                <p class="desc">Solo tienes que crear e invitar a otros para realizar sus modelos de dominio</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6">
                        <div class="service">
                            <div class="icon" data-animation="true" data-animation-type="animate__bounceIn"><i
                                    class="fa fa-file"></i></div>
                            <div class="info">
                                <h4 class="title">Notificaciones rápida</h4>
                                <p class="desc">Los usuarios serán notificados rápidamente si fueron invitados para realizar los diagramas con otros usuarios la mismo tiempo</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="{{ asset('asset/js/one-page-parallax/vendor.min.js') }}"></script>
    <script src="{{ asset('asset/js/one-page-parallax/app.min.js') }}"></script>

    <script src="{{ asset('asset/js/vendor.min.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y3Q0VGQKY3" type="4079fc477c4ac488718e0b14-text/javascript"></script>
    
</body>

</html>
