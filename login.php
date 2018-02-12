<!DOCTYPE html>
<html lang="en">
<?php

ob_start();
session_start();
if(isset($_SESSION["userId"])){
    header("Location: index");
}

require_once ("system/classes/users.php");
$users = new users();
?>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MGLife | Login</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="js/sweetalert.min.js"></script>
    <!-- Custom styles for this template -->
    <style>
      body {
        padding-top: 54px;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }

    </style>

  </head>

  <body>

    <?php include_once "includes/menu.php";?>

    <!-- Page Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center text-white mb-4">Bootstrap 4 Login Form</h2>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <span class="anchor" id="formLogin"></span>

                        <!-- form card login -->
                        <div class="card rounded-0">
                            <div class="card-header">
                                <h3 class="mb-0">Login</h3>
                            </div>
                            <div class="card-body">
                                <form class="form" role="form" autocomplete="off" id="formLogin" method="post" action="login.php">
                                    <div class="form-group">
                                        <label for="lb_username">Username</label>
                                        <input type="text" class="form-control form-control-lg rounded-0" name="lb_username" id="lb_username" >
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control form-control-lg rounded-0" id="pwd1" autocomplete="new-password" name="lb_password" id="lb_password">
                                    </div>
                                    <button type="submit" name="btnlogin" class="btn btn-success btn-lg float-right">Login</button>

                                <?php
                                if(isset($_POST["btnlogin"])){
                                    if(empty($_POST["lb_username"])){
                                        echo  '<script> swal("Error", "Tem de escrever o username!", "error")</script>';
                                    }elseif(empty($_POST["lb_password"])){
                                        echo  '<script> swal("Error", "Tem de escrever a password!", "error")</script>';
                                    }else{
                                        $username = $users->quote($_POST["lb_username"]);
                                        $password = $users->quote($_POST["lb_password"]);
                                        $users->Login($username,$password);
                                    }
                                    //$username = $users->quote($_POST);
                                }
                                ?>
                                </form>
                            </div>
                            <!--/card-block-->
                        </div>
                        <!-- /form card login -->

                    </div>


                </div>
                <!--/row-->

            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div>
    <!--/container-->

    <!-- Bootstrap core JavaScript -->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
