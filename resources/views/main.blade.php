<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       @include('partials.head')
        <title>Jobs</title>
    </head>
    <body>
            @yield('content')
    </body>
</html>
