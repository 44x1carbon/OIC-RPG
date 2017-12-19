<html>
    <head>

    </head>
    <body>
        @component('Shared._Header')
            @yield('header_title')
        @endcomponent

        @yield('content')
    </body>
</html>