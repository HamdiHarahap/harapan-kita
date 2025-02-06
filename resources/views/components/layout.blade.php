<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    @vite(['resources/css/app.css', 'resources/js/main.js'])
</head>
<body>
    <x-header></x-header>

    <main class="min-h-screen">
        {{$slot}}
    </main>

    <x-footer></x-footer>
</body>
</html>