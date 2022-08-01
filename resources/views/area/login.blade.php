<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('/css/area.css') }}">
    <style>
        html, body{
            height: 100%;
        }
        body{
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
        }
        main{
            width: 400px;
            min-width: 320px;
        }
        #login{
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        #password{
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .form-floating:focus-within {
            z-index: 2;
        }
    </style>
</head>
<body>
<main class="mx-auto">
    @if($errors->any())<div class="alert alert-danger text-center mb-4">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('area.login', [], false) }}">
        @csrf
    <div class="form-floating">
        <input type="text" id="login" name="login" class="form-control" placeholder="Username or email" value="{{ old('login') }}">
        <label for="login">Username or email</label>
    </div>
    <div class="form-floating">
        <input type="password" id="password" name="password" class="form-control" placeholder="Username or email">
        <label for="password">Password</label>
    </div>
    <div class="form-check mt-2 ms-1">
        <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
        <label class="form-check-label" for="remember">remember me</label>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary px-3">Login</button>
    </div>
    </form>
</main>
</body>
</html>

