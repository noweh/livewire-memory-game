<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Fantasy Memory Quest</title>
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    @livewireStyles
</head>
<body>
    @livewire('memory-game')
    <script src="{{ asset('js/app.min.js') }}"></script>
    @livewireScripts
</body>
</html>