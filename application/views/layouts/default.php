<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!--    <script type="text/javascript" src="/public/scripts/form.js"></script>-->
    <title><?php echo "$title"; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/header.css">
    <link rel="stylesheet" href="/public/styles/footer.css">

</head>
<body>

<section id="maket">
    <?php require_once "Application/views/layouts/header.php" ?>

    <?php echo "$content"; ?>

</section>

<!--<div id="rasporka"></div>-->

<?php require_once "Application/views/layouts/footer.php" ?>


</body>
</html>