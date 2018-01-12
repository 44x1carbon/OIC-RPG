<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1">
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
        {{--<script>--}}
            {{--document.body.onclick = function () {--}}
                {{--console.log('hoge')--}}
                {{--document.body.webkitRequestFullscreen();--}}
            {{--}--}}
            {{--document.body.click();--}}
        {{--</script>--}}
    </body>
</html>
