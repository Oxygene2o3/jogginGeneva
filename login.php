<?php
session_start();
require_once 'application.php';

if (isset($_REQUEST["modalForm"])) {
    $NewName = filter_input(INPUT_POST, 'NewName', FILTER_SANITIZE_SPECIAL_CHARS);
    $NewPassword = filter_input(INPUT_POST, 'NewPassword', FILTER_SANITIZE_SPECIAL_CHARS);
    $NewPasswordConfirmed = filter_input(INPUT_POST, 'NewPasswordConfirmed', FILTER_SANITIZE_SPECIAL_CHARS);
    if ((!empty($NewName)) && (!empty($NewPassword)) && (!empty($NewPasswordConfirmed))) {
        if ($NewPassword == $NewPasswordConfirmed)
            $NewData = AddUser($NewName, $NewPassword);
    }
}

if (isset($_REQUEST["btnSubmit"])) {
    $UserName = filter_input(INPUT_POST, 'UserName', FILTER_SANITIZE_SPECIAL_CHARS);
    $UserPassword = filter_input(INPUT_POST, 'UserPassword', FILTER_SANITIZE_SPECIAL_CHARS);
    $data = CheckLogin($UserName, $UserPassword);
    if ($data != false) {
        $_SESSION['user_logged'] = $data;
        header('Location: index.php');
    }
}

if(!empty($NewData)){
    $error = '<span id="helpBlock" class="help-block">this name is already assigned</span>';  
}else{
    $error = "";
}
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
        <link href="BootStrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title>JogginGeneva</title>

    </head>
    <body>
        <!-- MENU -->
        <div class="navbar-wrapper">
            <div class="container">
                <?php
                echo menu();
                ?>

            </div>
        </div>
        <!-- CONTENT1 -->
        <div class="container marketing">
            <form action="#" method="post">
                <div class="input-group input-group-lg form-group">
                    <input type="text" class="form-control" placeholder="Username" name='UserName' required aria-describedby="basic-addon2">
                    <span class="input-group-addon" id="basic-addon2">★</span>
                </div> 
                <div class="input-group input-group-lg form-group">
                    <input type="password" class="form-control" placeholder="Password" name='UserPassword' required aria-describedby="basic-addon2">
                    <span class="input-group-addon" id="basic-addon2">★</span>
                </div> 
                <?php echo $error ?>
                <br>
                <button type="submit" class="btn btn-default btn-lg btn-block" name='btnSubmit'>Submit</button>
            </form>     
            <br>
            <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#myModal">
                Register Here
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="login.php" method="post" id="registerForm">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Register</h4>
                            </div>
                            <div class="modal-body">
                                <div class="input-group input-group-lg form-group">
                                    <input type="text" class="form-control" placeholder="Username"  name='NewName' required aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2">★</span>
                                </div> 
                                <div class="input-group input-group-lg form-group">
                                    <input type="password" class="form-control" placeholder="Password" name='NewPassword' required aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2">★</span>
                                </div> 
                                <div class="input-group input-group-lg form-group">
                                    <input type="password" class="form-control" placeholder="Confirme Password" required name='NewPasswordConfirmed' aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2">★</span>
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" name="modalForm" class="btn btn-primary">Let's Go</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <footer>
                <p class="pull-right"><a href="#">&#x23CF;</a></p>
                <p>&copy; 2015 Dello Buono Fabio</p>
            </footer>
        </div>



        <!-- Bootstrap script  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="./BootStrap/js/bootstrap.min.js"></script>
    </body>
</html>
