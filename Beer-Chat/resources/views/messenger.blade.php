<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (Auth::check())
        <meta name="user_id" content="{{ Auth::user()->id }}" />
    @endif
    <link rel="stylesheet" href="{{ asset("css/reset200802.css") }}">
    <link rel="stylesheet" href="{{ asset("css/messenger.css") }}"/>
    <link rel="stylesheet" href="{{ asset("css/app.css") }}"/>
    <script src="{{ asset("js/bootstrap.js") }}"></script>
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
                    <ul class="messages" id="messages">
                        {{--<li class="left-message message-block">
                            <img class="low-user-image" src="{{$url}}" alt="profile">
                            <div class="message">
                                <span class="message-text">${message.text}</span>
                            </div>
                        </li>--}}
                    </ul>
                </div>
                <div
                    class="messenger-input"
                    id="messageForm">
                    <div class="messenger-input-block">
                        <input
                            class="text-input"
                            type="text"
                            placeholder="write a message..."
                            id="message"
                            minlength="1"
                            maxlength="255"
                            name="message">
                        <button type="button" class="message-btn" id="messageSender">Отправить</button>
                    </div>
                </div >
            </section>
        </li>
    </ul>

<script src="{{ asset("js/app.js") }}"></script>
<script src="{{ asset("js/messenger.js") }}"></script>
</body>
</html>
