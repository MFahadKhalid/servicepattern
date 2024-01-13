<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{  env('APP_NAME') }} | @stack('titles')</title>
    @include('partial.style')
    @stack('styles')
</head>
<body>
    @include('partial.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light dark:bg-transparent">
        @include('partial.header')
        @yield('content')
        @include('partial.footer')
    </div>
    @include('partial.script')
    @stack('scripts')
</body>
</html>
