<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (Auth::check())
        <meta name="user_id" content="{{ Auth::user()->id }}"/>
    @endif
    <link rel="stylesheet" href="{{ asset("css/reset200802.css") }}">
    <link rel="stylesheet" href="{{ asset("css/messenger.css") }}"/>
    <link rel="stylesheet" href="{{ asset("css/app.css") }}"/>
    <link rel="stylesheet" href="{{ asset("css/admin.css") }}"/>
    <script src="{{ asset("js/bootstrap.js") }}"></script>
    <title>Admin panel</title>
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
        <section class="messenger-column" id="admin-section">
            <div class="messenger-header">
                <span class="messenger-header-text" id="chat-name">Admin panel</span>
            </div>
            <div class="big-user-info center" id="user-info">
                <span class="notify-text">Select user for view info</span>
            </div>
            <div class="admin-chats">
                <div class="admin-chats-header">
                    <span class="header-name">user's chats</span>
                </div>
                <ul class="user-chats center" id="user-chats">
                    <span class="notify-text">Select user for view info</span>
                </ul>
            </div>
        </section>
    </li>
</ul>
<script src="{{asset("js/MD5.js")}}"></script>
<script src="{{ asset("js/app.js") }}"></script>
<script src="{{ asset("js/admin.js") }}"></script>
<script src="{{ asset("js/loader.js") }}"></script>
</body>
</html>
