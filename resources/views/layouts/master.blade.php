<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield("title") </title>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield("styles")
</head>

<body>


@include("inc.topNav")

<div class="container">

    <div class="row">
        <div class="col-sm-12 py-4" id="mainContent">
            @include("inc.sessionMessages")
            @yield('content')
            @include("inc.errorMessages")
        </div>
    </div>

</div>


<script src="{{ asset('js/app.js') }}"></script>
@yield("scripts")
</body>
</html>
