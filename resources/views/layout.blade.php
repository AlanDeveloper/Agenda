<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <title>Agenda</title>
</head>
<body>
    <header>
        <h1>Home</h1>
        <button id="closeMenu"><i class="tes te-menu"></i></button>
    </header>
    <main>
        <div id="content">
            @yield('content')
        </div>
        @include('components.menu')
    </main>
    <footer>

    </footer>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
</body>
</html>
