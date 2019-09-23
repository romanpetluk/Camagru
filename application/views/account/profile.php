<!---->
<!--<H2>PROFILE</H2>-->
<!--<form action="/account/profile" method="post">-->
<!--    <label>login</label>-->
<!--    <BR>-->
<!--    <input type="text" value="--><?php //echo $_SESSION['account']['login']; ?><!--" name="login">-->
<!--    <BR>-->
<!--    <label>email</label>-->
<!--    <BR>-->
<!--    <input type="text" value="--><?php //echo $_SESSION['account']['email']; ?><!--" name="email">-->
<!--    <BR>-->
<!--    <label>password</label>-->
<!--    <BR>-->
<!--    <input type="password" name="password">-->
<!--    <BR>-->
<!--    <button type="submit">save</button>-->
<!--</form>-->


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
<section class="profile">
    <h2 class="profile__title-text">PROFILE</h2>
    <form class="profile__field" action="/account/profile" method="post">
        <div class="profile__login">
            <p>Login</p>
            <input class="profile__login-input" type="text" value="<?php echo $_SESSION['account']['login']; ?>" name="login">
        </div>
        <div class="profile__email">
            <p>Email</p>
            <input class="profile__email-input" type="text" value="<?php echo $_SESSION['account']['email']; ?>" name="email">
        </div>
        <div class="profile__password">
            <p>Password</p>
            <input class="profile__password-input" type="password" name="password">
        </div>
        <?php if ($_SESSION['account']['notify']): ?>
            <p><input class="profile__login-input" type="checkbox" name="notify" value="1" checked>Notify</p>
        <?php else: ?>
            <p><input class="profile__login-input" type="checkbox" name="notify" value="0">Notify</p>
        <?php endif; ?>
        <button class="profile__btn" type="submit">Save</button>
    </form>
</section>

</body>
</html>