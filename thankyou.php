<?php

require 'includes/functions.php';

$username = filterUserName($_GET['username']);

if($_GET['type'] == 'login')
{
    $message = 'Thank you '.$username.' for logging in!';
}
else
{
    $message = 'Thank you '.$username.' for signing up!';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>COMP 3015</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div id="wrapper">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1 class="login-panel text-center text-muted">
                    COMP 3015 Assignment 2
                </h1>
                <hr/>
                <div class="alert alert-success text-center">
                    <?php echo $message; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <a href="posts.php" class="btn btn-default btn-lg">
                    <i class="fa fa-list"></i> Posts
                </a>
            </div>
        </div>

    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
