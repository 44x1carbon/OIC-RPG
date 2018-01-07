<html>
    <head>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    </head>
    <body>
        @component('Shared._Header')
            @yield('header_title')
        @endcomponent
        <main class="main">
            @yield('content')
        </main>
        @component('Shared._footer')
        @endcomponent
    </body>
</html>
