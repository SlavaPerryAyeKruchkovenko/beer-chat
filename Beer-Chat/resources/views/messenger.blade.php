<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        <li class="left-message message-block">
                            <img class="low-user-image" src="{{$url}}" alt="profile">
                            <div class="message">
                                <span class="message-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</span>
                            </div>
                        </li>
                        <li class="right-message message-block">
                            <img class="low-user-image" src="{{$url}}" alt="profile">
                            <div class="message">
                                <span class="message-text">hello slava i am timur</span>
                            </div>
                        </li>
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
                            id="message" minlength="1"
                            name="message">
                        <button type="button" class="messange-btn" id="messageSender">Отправить</button>
                    </div>
                </div >
            </section>
        </li>
    </ul>

<script src="{{ asset("js/app.js") }}"></script>
<script src="{{ asset("js/messenger.js") }}"></script>
</body>
</html>
