<!DOCTYPE html>
<html lang="pt">
<?php
ob_start();
session_start();
require_once ("../../system/classes/patrulha.php");
require_once ("../../system/classes/users.php");
$patrulha = new patrulha();
$users = new users();

if($users->IsLogged($_SESSION["userId"])){
    $userIdLogado = $_SESSION["userId"];
    if($users->GetAdminLvl(0,$userIdLogado) == 0){
        header("Location: ../../logout.php");
    }
}else{
    header("Location: ../../login.php");
}
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
        <h2>Criar Zona</h2>
        <form action="CreateZona.php" method="post" autocomplete="false">
            <div class="form-group">
                <label for="lb_c_zona">Zona</label>
                <input type="text" class="form-control" id="lb_c_zona" name="lb_c_zona">
            </div>

            <button type="submit" name="concluir" class="btn btn-success">Concluir</button>
            <?php
            if(isset($_POST["concluir"])){

                if(empty($_POST["lb_c_zona"])){
                    echo  '<script> swal("Error", "Tem de escrever o nome da zona!", "error")</script>';
                }else{
                    $zona = $patrulha->quote($_POST["lb_c_zona"]);

                    $patrulha->NewZona($zona);

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
