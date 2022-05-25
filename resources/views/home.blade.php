<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <br>
        <div class="row">
            <div class="col text-center">
                @guest
                    <a href="{{ \App\Services\GoogleService::link() }}" class="btn btn-outline-danger" role="button">Sign in with Google</a>
                @endguest
                @auth
                    <p>Hello, {{ \Illuminate\Support\Facades\Auth::user()->first_name . ' ' . \Illuminate\Support\Facades\Auth::user()->last_name . ' [' . \Illuminate\Support\Facades\Auth::user()->email . ']'}}</p>
                    <a href="{{ route('logout') }}" class="btn btn-secondary" role="button">Logout</a>
                @endauth
            </div>
        </div>
    </div>


</body>
</html>
