<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Festibari</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    @stack('styles')
</head>
<body style="background-color: #000; color: #fff; font-family: 'Poppins', sans-serif;">
    
    @include('partials.nav') 
    
    <div class="content">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
