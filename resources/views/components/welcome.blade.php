<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <title>{{ config('app.name', 'DefaultAppName') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        @include('layouts.content')
    </div>


    <footer class="bg-white mt-30">
        @include('layouts.footer')
    </footer>



</body>

</html>
