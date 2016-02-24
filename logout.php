<?php
session_start();
$_SESSION = [];
header("Location: index.php");
exit();
session_destroy();

require_once ("application.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="./images/bootstrap.ico">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="carousel.css" rel="stylesheet">

        <title>BootStrap</title>

    </head>
    <body>

    </body>
</html>

