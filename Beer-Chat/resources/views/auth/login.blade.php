<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset("css/reset200802.css") }}">
    <link rel="stylesheet" href="{{ asset("css/authentication.css") }}"/>
    <link rel="stylesheet" href="{{ asset("css/app.css") }}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <title>Login</title>

</head>
<body>
<div class="login">
    <div class="login-sign">
        <h1 class="login-title">Login🍺</h1>
        <div class="login-body">
            <form
                class="login-form"
                action="{{ route('login') }}"
                method="post"
                novalidate
                autocomplete="off"
                id="loginForm">
                @csrf
                <div class="{{ $errors->has('email') ? 'error-separator' : 'separator' }}">
                    <input
                        id="email"
                        name="email"
                        class="login-form-input"
                        type="email"
                        placeholder="Email"
                        required
                        value="{{old('email')}}"/>
                    @error('email')
                    <div class="login-form-error">
                        <i data-feather="alert-circle" class="alert"></i>
                    </div>
                    @enderror
                </div>
                @error('email')
                <div class="error-text">
                    <span>{{ $message }}</span>
                </div>
                @enderror
                <div class="{{ $errors->has('password') ? 'error-separator' : 'separator' }} password-block">
                    <input
                        id="password"
                        name="password"
                        class="password"
                        required type="password"
                        placeholder="Password"
                        minlength="8"
                        value="{{old('password')}}">
                    <div class="eye">
                        <i data-feather="eye" class="icon"></i>
                    </div>
                </div>
                @error('password')
                <div class="error-text">
                    <span>{{ $message }}</span>
                </div>
                @enderror
                <p class="separator">
                    <button class="submit-btn" type="submit" id="submit">
                        Continue
                        <i data-feather="log-in" class="log-in icon"></i>
                    </button>
                </p>
            </form>
            <div class="another-links">
                <a class="back-link link left" href="{{route('register')}}">
                    <i data-feather="arrow-left" class="icon"></i>
                    <span>Create account</span>
                </a>
                <a class="back-link link right" href="#">
                    <span>Forgot password?</span>
                    <i data-feather="arrow-right" class="icon"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("js/app.js") }}"></script>
<script src="{{ asset("js/authentication.js") }}"></script>
</body>
</html>
