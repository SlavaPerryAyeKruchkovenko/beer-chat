<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BEER CHAT</title>
</head>
<body>
<form method="post" action="{{route('logout')}}">
    @csrf
    <button type="submit">log out</button>
</form>

</body>
</html>
