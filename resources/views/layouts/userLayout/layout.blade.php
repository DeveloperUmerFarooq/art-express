<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.headlinks')
    <title>Art-Express</title>
</head>
<body>
@include('layouts.userLayout.header')
<main>
    @yield('page')
</main>
@include('layouts.userLayout.footer')
@include('layouts.scriptlinks')

    @stack('scripts')
</body>
</html>
