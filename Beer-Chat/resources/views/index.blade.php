<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset("css/reset200802.css") }}">
        <link rel="stylesheet" href="{{ asset("css/main.css") }}"/>
        <link rel="stylesheet" href="{{ asset("css/app.css") }}"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
        <title>BEER CHAT</title>
    </head>
    <body>
        <header class="main-header">
            <nav class="nav-bar">
                <div class="nav-bar-title">
                    <img src="{{ asset("images/cheers.png") }}" alt="beer"/>
                    <h1 class="nav-bar-title-text">Beer Chat</h1>
                </div>
                <ul class="auth">
                    <li class="pa2 mr3 pointer"><a href="{{ route('login') }}">Sign In</a></li>
                    <li class="red-border"><a href="{{ route('register') }}">Sign Up</a></li>
                </ul>
            </nav>
        </header>
        <main class="main">
            <section class="main-body">
                <div class="main-content">
                    <div class="main-content-text">
                        <h1>Beer-to-Beer Meeting for flex</h1>
                        <h2 class="sub-title">Improves the efficiency of beer consumption</h2>
                    </div>
                    <img src="{{ asset("images/beer-chat.png") }}" class="example" alt="beer chat">
                </div>
                <h2 class="another-information">
                    Beer is<span class="gray"> helper </span>
                    for communicate
                    <span class="gray"> between </span>peoples
                </h2>
                <div class="another-information">
                    <a class="red-border another-information-button" href="{{ route('messenger') }}">
                        Get Started
                    </a>
                </div>
            </section>
        </main>
    </body>
</html>
