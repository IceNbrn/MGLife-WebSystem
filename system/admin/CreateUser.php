<!DOCTYPE html>
<html lang="pt">
<?php
ob_start();
session_start();
require_once ("../../system/classes/users.php");
$users = new users();
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MGLife | Admin Painel</title>

    <!-- Bootstrap core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/home.css" rel="stylesheet">
    <script src="../../js/sweetalert.min.js"></script>
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

<?php include_once "../../includes/menu.php" ?>

<!-- Page Content -->
<div class="row">
    <div class="container">
        <h2>Criar Utilizador</h2>
        <form action="CreateUser.php" method="post" autocomplete="false">
            <div class="form-group">
                <label for="lb_c_username">Username</label>
                <input type="text" class="form-control" id="lb_c_username" name="lb_c_username">
            </div>
            <div class="form-group">
                <label for="lb_c_steamid">Steam Id</label>
                <input type="text" class="form-control" id="lb_c_steamid" name="lb_c_steamid">
            </div>
            <div class="form-group">
                <label for="lb_c_password">Password:</label>
                <input type="password" class="form-control" id="lb_c_password" name="lb_c_password">
            </div>
            <div class="form-group">
                <label for="lb_c_rpassword">Repeat Password:</label>
                <input type="password" class="form-control" id="lb_c_rpassword" name="lb_c_rpassword">
            </div>
            <button type="submit" name="concluir" class="btn btn-success">Concluir</button>
            <?php
            if(isset($_POST["concluir"])){

                if(empty($_POST["lb_c_username"])){
                    echo  '<script> swal("Error", "Tem de escrever o username!", "error")</script>';
                }elseif(empty($_POST["lb_c_steamid"])){
                    echo  '<script> swal("Error", "Tem de escrever o steamid!", "error")</script>';
                }elseif(empty($_POST["lb_c_password"])){
                    echo  '<script> swal("Error", "Tem de escrever a password!", "error")</script>';
                }elseif(empty($_POST["lb_c_rpassword"])){
                    echo  '<script> swal("Error", "Tem de confirmar a password!", "error")</script>';
                }else{
                    $username = $users->quote($_POST["lb_c_username"]);
                    $steamid = $users->quote($_POST["lb_c_steamid"]);
                    $password = $users->quote($_POST["lb_c_password"]);
                    $rpassword = $users->quote($_POST["lb_c_rpassword"]);

                    if($password == $rpassword){
                        $password = sha1(md5($password));
                        $users->CreateUser($username,$password,$steamid);
                    }else{
                        echo  '<script> swal("Error", "As passwords têm de ser iguais!", "error")</script>';
                    }
                }
            }
            ?>
        </form>
    </div>
</div>


<!-- Bootstrap core JavaScript -->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
