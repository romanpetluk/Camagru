<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo "$title"; ?></title>
</head>
<body>

<H2>PROFILE</H2>
<form action="/account/profile" method="post">
    <label>login</label>
    <BR>
    <input type="text" value="<?php echo $_SESSION['account']['login']; ?>" name="login">
    <BR>
    <label>email</label>
    <BR>
    <input type="text" value="<?php echo $_SESSION['account']['email']; ?>" name="email">
    <BR>
    <label>password</label>
    <BR>
    <input type="password" name="password">
    <BR>
    <button type="submit">save</button>
</form>
</body>
</html>