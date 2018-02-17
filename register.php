<!DOCTYPE html>
<html lang="pt">
<?php
ob_start();
session_start();
require_once ("system/classes/users.php");
$users = new users();
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MGLife | Registar</title>

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

<?php include_once "includes/menu.php" ?>

<!-- Page Content -->
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-white mb-4">Login</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <span class="anchor" id="formLogin"></span>

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Registar</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formLogin" method="post" action="register.php">
                                <div class="form-group">
                                    <label for="lb_c_steamid">Steam ID</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" id="lb_c_steamid" name="lb_c_steamid" >
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0"  autocomplete="new-password" id="lb_c_password" name="lb_c_password">
                                </div>
                                <div class="form-group">
                                    <label>Repeat Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0"  autocomplete="new-password" id="lb_c_rpassword" name="lb_c_rpassword">
                                </div>
                                <button type="submit" name="concluir" class="btn btn-success">Concluir</button>
                                <a href="login.php">Login</a>
                                <?php
                                if(isset($_POST["concluir"])){

                                    if(empty($_POST["lb_c_steamid"])){
                                        echo  '<script> swal("Error", "Tem de escrever o steamid!", "error")</script>';
                                    }elseif(empty($_POST["lb_c_password"])){
                                        echo  '<script> swal("Error", "Tem de escrever a password!", "error")</script>';
                                    }elseif(empty($_POST["lb_c_rpassword"])){
                                        echo  '<script> swal("Error", "Tem de confirmar a password!", "error")</script>';
                                    }else{
                                        $steamid = $users->quote($_POST["lb_c_steamid"]);
                                        $password = $users->quote($_POST["lb_c_password"]);
                                        $rpassword = $users->quote($_POST["lb_c_rpassword"]);
                                        if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password))
                                        {
                                            if(preg_match('/[A-Z]/', $password)){
                                                if($password == $rpassword){
                                                    $password = sha1(md5($password));
                                                    $users->Register($steamid,$password);
                                                }else{
                                                    echo  '<script> swal("Error", "As passwords têm de ser iguais!", "error")</script>';
                                                }
                                            }
                                        }else{
                                            echo  '<script> swal("Error", "A password tem que conter no minimo 1 Numero e 1 Letra grande!", "error")</script>';
                                        }


                                    }
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


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
