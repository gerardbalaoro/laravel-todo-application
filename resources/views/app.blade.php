<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ url('/site.webmanifest') }}">

    <style>[x-cloak]{display:none}</style>
    @googlefonts
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="relative flex items-start justify-center h-full text-gray-900 bg-gray-50">
    <div class="flex flex-col items-center justify-between w-full max-w-lg px-4 mx-auto 2xl:px-0">
        <h1 class="flex items-center justify-between gap-4 mx-auto my-8 text-3xl font-bold">
            <x-logo class="w-10 h-10"/>
            {{ config('app.name') }}
        </h1>
        <x-tasks.create class="w-full"/>
        <x-tasks class="w-full"/>
    </div>
    <x-toast/>
    <script>
        window.app = @json([
            'baseUrl' => url('/'),
        ]);
    </script>
</body>
</html>
