<!DOCTYPE html>
<html lang="pt">
<?php
ob_start();
session_start();
require_once ("../../system/classes/patrulha.php");
require_once ("../../system/classes/users.php");
$users = new users();
$patrulha = new patrulha();

if($users->IsLogged($_SESSION["userId"])){
    $userIdLogado = $_SESSION["userId"];
    if($users->GetCopLvl(0,$userIdLogado) == 0){
        header("Location: ../../logout.php");
    }
}else{
    header("Location: ../../login.php");
}


if(isset($_GET["id"])){
    $Id = $users->quote($_GET["id"]);

    $sql = "SELECT * FROM reportv WHERE id = $Id";
    $result = $users->query($sql);
    $num_rows = $result->num_rows;
    if($num_rows > 0){
        $userData = $result->fetch_array();
        $status = $userData["status"];
    }
}
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MGLife | Atualizar Veículo</title>

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
        <h2>Atualizar Veículo</h2>
        <form role="form" id="formLogin" method="post" action="atualizarv.php?id=<?=$Id?>">

            <div class="form-group">
                <label for="sl_stats">Estado</label>
                <select class="form-control form-control-lg rounded-0" name="sl_status" id="sl_status">
                    <?php if($status == 1){?>
                        <option selected value="1" >Procurado</option>
                        <option value="0" >Encontrado</option>
                    <?php }else{?>
                        <option value="1" >Procurado</option>
                        <option selected value="0" selected>Encontrado</option>
                    <?php }?>
                </select>
            </div>
            <button type="submit" name="btnconcluir" class="btn btn-success">Concluir</button>
            <?php
            if(isset($_POST["btnconcluir"])){
                if(empty($_POST["sl_status"]) && $_POST["sl_status"] != 0){
                    //echo $_POST["sl_status"];
                    echo  '<script> swal("Error", "Tem de selecionar o estado!", "error")</script>';
                }else{
                    $status = $users->quote($_POST["sl_status"]);

                    $patrulha->UpdateVeiculo($Id,$status);
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
