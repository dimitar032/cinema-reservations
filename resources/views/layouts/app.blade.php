<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Google Fonts -->
    <link href="{{ asset('template_default/css/google_fonts.css') }}" rel="stylesheet">

    <style type="text/css">
    @font-face {
      font-family: 'Material Icons';
      font-style: normal;
      font-weight: 400;
      src: url({{ asset('template_default/css/fonts.woff2') }}) format('woff2');
      }

  .material-icons {
      font-family: 'Material Icons';
      font-weight: normal;
      font-style: normal;
      font-size: 24px;
      line-height: 1;
      letter-spacing: normal;
      text-transform: none;
      display: inline-block;
      white-space: nowrap;
      word-wrap: normal;
      direction: ltr;
      -moz-font-feature-settings: 'liga';
      -moz-osx-font-smoothing: grayscale;
  }

    </style>

    <!-- Styles -->
    <link href="{{ asset('template_default/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template_default/css/waves.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template_default/css/animate.min.css') }}" rel="stylesheet">
    @stack('css')
    <link href="{{ asset('template_default/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template_default/css/theme-red.min.css') }}" rel="stylesheet">
</head>


@if(auth()->check())
<body class="theme-red">
@else
<body class="theme-red" style="margin-left: -300px;">
@endif
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <!-- #END# Search Bar -->
    
    <!-- Top Bar -->
    @include('layouts.partials.top_bar')
    <!-- #Top Bar -->
    @include('layouts.partials.side_bar')

    <section class="content">
        @include('flash::message')
        @yield('content')
    </section>

    <!-- Js -->
    <script src="{{asset('template_default/js/jquery.min.js')}}"></script>
    <script src="{{asset('template_default/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template_default/js/bootstrap-select.min.js')}}"></script>
    @stack('js')
    <script src="{{asset('template_default/js/jquery-slimscroll.js')}}"></script>
    <script src="{{asset('template_default/js/waves.min.js')}}"></script>
    <script src="{{asset('template_default/js/admin.js')}}"></script>
    <script src="{{asset('template_default/js/demo.js')}}"></script>

</body>
</html>




