<!DOCTYPE html>
<html lang="pt">
<?php
ob_start();
session_start();
require_once ("../../system/classes/users.php");
$users = new users();

if($users->IsLogged($_SESSION["userId"])){
    $userIdLogado = $_SESSION["userId"];
    if($users->GetAdminLvl(0,$userIdLogado) == 0){
        header("Location: ../../logout.php");
    }
}else{
    header("Location: ../../login.php");
}

if(isset($_GET["id"])){
    $userId = $users->quote($_GET["id"]);

    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $users->query($sql);
    $num_rows = $result->num_rows;
    if($num_rows > 0){
        $userData = $result->fetch_array();
        $username = $userData["username"];
        $password = $userData["password"];
        $steamid = $userData["steamid"];
        $deleted = $userData["deleted"];
    }
}
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MGLife | Edit User</title>

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
        <h2>Editar Utilizador</h2>
        <form action="EditUser.php?id=<?=$userId?>" method="post" autocomplete="false">
            <div class="form-group">
                <label for="lb_c_username">Username</label>
                <input type="text" class="form-control" id="lb_c_username" value="<?= $username?>" name="lb_c_username">
            </div>
            <div class="form-group">
                <label for="lb_c_steamid">Steam Id</label>
                <input type="text" class="form-control" id="lb_c_steamid" value="<?= $steamid?>" name="lb_c_steamid">
            </div>
            <div class="form-group">
                <label for="lb_c_deleted">Deleted</label>
                <input type="text" class="form-control" id="lb_c_deleted" value="<?= $deleted?>" name="lb_c_deleted">
            </div>
            <div class="form-group">
                <label for="lb_c_password">Password:</label>
                <input type="password" class="form-control" id="lb_c_password" value="<?= $password?>" name="lb_c_password">
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
                    $deleted = $users->quote($_POST["lb_c_deleted"]);

                    if($password == $rpassword){
                        $password = sha1(md5($password));
                        $users->EditUser($userId,$username,$password,$steamid,$deleted);
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
<?=require_once ("includes/footer.php")?>
</body>

</html>
