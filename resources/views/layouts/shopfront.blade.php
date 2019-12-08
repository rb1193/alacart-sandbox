<html>
    <head>
        <title>{{ config('app.name') }} @yield('title')</title>
    </head>
    <body>
        <main class="container">
            @yield('content')
        </main>
    </body>
</html>