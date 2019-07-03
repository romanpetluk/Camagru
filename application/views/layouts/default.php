<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<!--    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
<!--    <script type="text/javascript" src="/public/scripts/form.js"></script>-->
    <title><?php echo "$title"; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/header.css">
    <link rel="stylesheet" href="/public/styles/footer.css">
    <link rel="stylesheet" href="/public/styles/login.css">
    <link rel="stylesheet" href="/public/styles/register.css">
    <link rel="stylesheet" href="/public/styles/profile.css">
    <link rel="stylesheet" href="/public/styles/selfie.css">

</head>
<body>

<section id="maket">
    <?php require_once "application/views/layouts/header.php" ?>

    <?php echo "$content"; ?>

    <div id="rasporka"></div>

</section>



<?php require_once "application/views/layouts/footer.php" ?>

    <script src="/public/scripts/ajax.js"></script>
</body>
</html>