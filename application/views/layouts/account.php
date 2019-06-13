<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!--    <script type="text/javascript" src="/public/scripts/form.js"></script>-->
    <title><?php echo "$title"; ?></title>

</head>
<body style="background: #123121">

<?php if (isset($_SESSION['account']['user_id'])): ?>

    <li>
        <a href="/account/profile">
            <p><button type="submit" name="enter">profile</button></p>
        </a>

    </li>
    <li>
        <a href="/account/logout">
            <p><button type="submit" name="enter">logout</button></p>
        </a>
    </li>
<?php else: ?>
    <li>
        <a href="/account/login">
            <p><button type="submit" name="enter">login</button></p>
        </a>
    </li>
    <li>
        <a href="/account/register">
            <p><button type="submit" name="enter">register</button></p>
        </a>
    </li>


<?php endif; ?>

<?php echo "$content"; ?>

</body>
</html>