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
                <div class=" ">

                </div>
                {{--<form method="post" action="{{route('logout')}}">
                    @csrf
                    <button type="submit">log out</button>
                </form>--}}
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
                        <input class="text-input" type="text" placeholder="write a message... ">
                        <button type="submit">Отправить</button>
                    </div>
                </form >
            </section>
        </li>
    </ul>


</body>
</html>
