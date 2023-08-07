<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Login - KiosManga</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Comfortaa:wght@300;400;500;600;700&family=Patrick+Hand&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="{{asset('FontAwesome/css/all.css')}}">

    {{-- MyCss --}}
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <div class="login-header">
        <div>
            <div class="login-logo-text">
                <span id="login-title">Login ByMe</span>    
            </div>
        </div>
    </div>
    <div class="login-card">
{{--         <div class="card-title">Login ByMe</div> --}}
        <form action="{{route('auth')}}" method="POST">
            {{ csrf_field() }}
            @if ($errors->any())
            <div class="card-input error-message">
                Email & Password salah
            </div>
            @endif
            <div class="card-input">
                <label for="Username">Email</label>
                <input type="text" name="email" placeholder="youremail@gmail.com">
            </div>
            <div class="card-input">
                <label for="Password">Password</label>
                <input type="password" name="password" placeholder="your password">
            </div>
            <button type="submit" class="card-button">
                Login
            </button>
        </form>
        <div class="card-footer">
            <a href="{{ route('register-page') }}">Belum punya akun? Daftar</a>
        </div>
    </div>
</body>
</html>