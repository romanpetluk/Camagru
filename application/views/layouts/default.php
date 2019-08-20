<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo "$title"; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/header.css">
    <link rel="stylesheet" href="/public/styles/footer.css">
    <link rel="stylesheet" href="/public/styles/login.css">
    <link rel="stylesheet" href="/public/styles/register.css">
    <link rel="stylesheet" href="/public/styles/profile.css">
    <link rel="stylesheet" href="/public/styles/selfie.css">
    <link rel="stylesheet" href="/public/styles/gallery.css">

</head>
<body>

<section id="maket">
    <?php require_once "application/views/layouts/header.php" ?>

    <?php echo "$content"; ?>

    <div id="rasporka"></div>

</section>



<?php require_once "application/views/layouts/footer.php" ?>

    <script src="/public/scripts/ajax.js"></script>
    <script src="/public/scripts/selfie.js"></script>
</body>
</html>