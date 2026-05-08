<!DOCTYPE html>
<html lang="en" class="bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{ $title ?? 'MonascHerb' }}</title>
</head>

<body class="min-h-screen flex flex-col bg-white">

    <x-nav-bar></x-nav-bar>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-footer></x-footer>

</body>
</html>
