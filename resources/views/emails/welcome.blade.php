<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>Welcome to vegetablefree.com!</h1>
<p>We just need you to <a href="{{ url("auth/confirm/{$verification_token}") }}">confirm</a> your email address!</p>
</body>
</html>