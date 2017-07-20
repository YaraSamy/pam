<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PAM</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PAM') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <!-- Bootstrap core CSS     -->
    <link href="{{url('public/admin/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="{{url('public/admin/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{url('public/admin/css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{url('public/admin/css/demo.css')}}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{url('public/admin/css/pe-icon-7-stroke.css')}}" rel="stylesheet"/>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="grey" data-image="{{url('public/admin/')}}/img/sidebar-5.jpg">


        <div class="sidebar-wrapper">
            {{--shows PAM Logo--}}
            <div class="logo">
                <a href="{{ url('/') }}"><img src="{{url('public/imgs/logo.png')}}"></a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="{{ url('admin') }}">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/sets') }}">
                        <i class="pe-7s-photo-gallery"></i>
                        <p>Sets</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/movies') }}">
                        <i class="pe-7s-film"></i>
                        <p>Movies</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">

                {{--check if NOT logged-in--}}
                @if (Auth::guest())
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>

            </div>
                @else
                    {{--user->logged-in--}}
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('admin') }}">Dashboard</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#">
                                    <i class="fa fa-search"></i>
                                    <p class="hidden-lg hidden-md">Search</p>
                                </a>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                {{--Logout--}}
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form"
                                      action="{{ 'App\Admin' == Auth::getProvider()->getModel() ? route('admin.logout') : route('logout') }}"
                                      method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            @endif
        </nav>
        {{--page content here--}}
        <div class="content">
            <div>
                @yield('content')
            </div>
        </div>

        {{--footer--}}
        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">
                    Copyright &copy; <a href="http://panarab-media.com/">Pan Arab Media Inc. </a>
                    <script>document.write(new Date().getFullYear())</script>
                </p>
            </div>
        </footer>

    </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="{{url('public/admin/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<script src="{{url('public/admin/js/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="{{url('public/admin/js/bootstrap-checkbox-radio-switch.js')}}"></script>

<!--  Charts Plugin -->
<script src="{{url('public/admin/js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{url('public/admin/js/bootstrap-notify.js')}}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{url('public/admin/js/light-bootstrap-dashboard.js')}}"></script>

<!-- Light Bootstrap Table DEMO methods for Demo purpose -->
<script src="{{url('public/admin/js/demo.js')}}"></script>


</html>
