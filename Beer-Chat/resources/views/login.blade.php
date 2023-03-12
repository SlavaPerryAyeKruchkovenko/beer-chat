<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset("css/reset200802.css") }}">
    <link rel="stylesheet" href="{{ asset("css/login.css") }}"/>
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
            <form class="login-form" >
                <p class="separator">
                    <input id="nickname" name="nickname" required type="email" placeholder="Nickname">
                </p>
                <div class="separator password-block">
                    <input id="password" class="password" required type="password" placeholder="Пароль" minlength="3">
                    <div class="eye" id="eye" onclick="authentication.changePasswordVisible('password')">
                        <i data-feather="eye" class="icon"></i>
                    </div>
                </div>
                <p class="separator">
                    <button class="submit-btn" type="submit" id="submit">
                        Войти
                        <i data-feather="log-in" class="log-in icon"></i>
                    </button>
                </p>
            </form>
            <div class="another-links">
                <a class="back-link link left" href="#">
                    <i data-feather="arrow-left" class="icon"></i>
                    <span>Cоздать аккаунт</span>
                </a>
                <a class="back-link link right" href="#">
                    <span>Забыли пороль?</span>
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
