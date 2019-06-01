<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo "$title"; ?></title>
</head>
<body style="background: #123121">

<?php echo "$content"; ?>
<?php if (isset($_SESSION['account']['id'])): ?>

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

</body>
</html>