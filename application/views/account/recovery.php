<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo "$title"; ?></title>
</head>
<body>
Recovery <br>
<a href="/account/login">sing in</a>

<h3>Register</h3>
<form action="/account/recovery" method="post">
    <p>Email</p>
    <p><input type="email" name="email"></p>
    <p><button type="submit" name="enter">send</button></p>
<!--    <p><a href="/account/login">login</a></p>-->
</form>

</body>
</html>

sendmail_path =/usr/sbin/sendmail -t -i -f  test@gmail.com