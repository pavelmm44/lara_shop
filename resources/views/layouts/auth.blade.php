<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', env('APP_NAME'))</title>

    @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    @if($message = flash()->get())
        <div class="{{ $message->class() }} p-5">
            {{ $message->message() }}
        </div>
    @endif

<main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
    <div class="container">

        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block" rel="home">
                Lara Shop
            </a>
        </div>

        @yield('content')

    </div>
</main>



</body>
</html>
