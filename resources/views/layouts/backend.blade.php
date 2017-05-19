<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ HTML::style(mix('assets/css/backend/app.css')) }}
    @stack('prestyles')
</head>
<body>
    <div id="app">
        @include('backend._partials.header')
        <div class="container">
            @yield('page-content')
        </div>
    </div>
    {{ HTML::script('vendor/jquery/jquery.min.js') }}
    {{ HTML::script('vendor/bootstrap/js/bootstrap.min.js') }}
    {{ HTML::script(mix('assets/js/backend/app.js')) }}
    @stack('prescripts')
</body>
</html>
