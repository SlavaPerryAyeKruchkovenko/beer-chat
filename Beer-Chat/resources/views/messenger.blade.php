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
                <div class="search-block">
                    <input class="search-input" id="search-message">
                    <div class="search-btn">
                        <i data-feather="search" class="icon"></i>
                    </div>
                </div>
                <div class="found-users">
                    <ul class="user-profiles" id="users">

                    </ul>
                </div>
            </section>
        </li>
        <li class="messenger-l-column">
            <section class="messenger-column">
                <div class="messenger-header">
                    <span class="messenger-header-text" id="chat-name">Hello, {{$user->name}}</span>
                </div>
                <div class="messenger-content">
                    <ul class="messages center" id="messages">
                        <h1 class="hello-text">Choose a chat for the start</h1>
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
<script src="{{asset("js/MD5.js")}}"></script>
<script src="{{ asset("js/app.js") }}"></script>
<script src="{{ asset("js/messenger.js") }}"></script>
<script src="{{ asset("js/loader.js") }}"></script>
</body>
</html>
