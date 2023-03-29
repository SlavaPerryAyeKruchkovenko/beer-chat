<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset("css/reset200802.css") }}">
    <link rel="stylesheet" href="{{ asset("css/messenger.css") }}"/>
    <link rel="stylesheet" href="{{ asset("css/app.css") }}"/>
    <title>BEER CHAT</title>
</head>
<body class="messenger-body">
    <ul class="messenger">
        <li class="messenger-s-column">
            <section class="messenger-column user-column">
                <div class="user-block">
                    <div class="user-info">
                        <img class="user-image" src="{{$url}}" alt="profile">
                        <span class="user-username">{{$user->username}}</span>
                    </div>
                    <span class="user-name">
                        {{$user->name}}
                    </span>
                    <form method="post" action="{{route('logout')}}" class="logout">
                        @csrf
                        <button type="submit" class="logout-btn">
                            Logout
                            <i data-feather="log-out" class="logout-icon icon"></i>
                        </button>
                    </form>
                </div>
                <form class="search-block">
                    <input class="search-input" id="search-message">
                    <div class="search-btn">
                        <i data-feather="search" class="icon"></i>
                    </div>
                </form>
                <div class="found-users">

                </div>
            </section>
        </li>
        <li class="messenger-l-column">
            <section class="messenger-column">
                <div class="messenger-header">
                    <span class="messenger-header-text">Username</span>
                </div>
                <div class="messenger-content">

                </div>
                <form class="messenger-input">
                    @csrf
                    <div class="messenger-input-block">
                        <input class="text-input" type="text" placeholder="write a message..." id="message">
                        <button type="submit" class="messange-btn">Отправить</button>
                    </div>
                </form >
            </section>
        </li>
    </ul>

<script src="{{ asset("js/app.js") }}"></script>
</body>
</html>
