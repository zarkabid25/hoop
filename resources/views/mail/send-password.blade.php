<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Password</title>
</head>
<body>
<h1>Login Password!</h1>
<p>Dear {{ $mailData['userName'] }} your login password is:  <strong>{{ $mailData['password'] }}</strong></p>

<p>Thank you</p>
</body>
</html>
