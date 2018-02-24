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

    $sql = "SELECT * FROM patrulhas WHERE id = $Id";
    $result = $users->query($sql);
    $num_rows = $result->num_rows;
    if($num_rows > 0){
        $userData = $result->fetch_array();
        $policia1 = $userData["policia"];
        $policia2 = $userData["policia2"];
        $status = $userData["status"];
        $zona = $userData["zona"];
    }
}
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MGLife | Atualizar Patrulha</title>

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
        <h2>Atualizar Patrulha</h2>
        <form role="form" id="formLogin" method="post" action="atualizarp.php?id=<?=$Id?>">
            <div class="form-group">
                <label for="lb_c_policia1">Policia nº1</label>
                <input type="text" class="form-control" value="<?= $policia1?>" name="lb_c_policia1" id="lb_c_policia1">
            </div>
            <div class="form-group">
                <label for="lb_c_policia2">Policia nº2</label>
                <input type="text" class="form-control" value="<?= $policia2?>" name="lb_c_policia2" id="lb_c_policia2">
            </div>
            <div class="form-group">
                <label for="sl_zona">Zona de Patrulhamento</label>
                <select class="form-control form-control-lg rounded-0" name="sl_zona" id="sl_zona">
                    <?php
                    $sql = "SELECT * FROM listapatrulhas";
                    $categorias = $patrulha->query($sql);
                    if($categorias->num_rows >0){
                        while ($row = $categorias->fetch_assoc()){
                            $nome = $row["zona"];
                            $id = $row["id"];
                            if($zona == $id){
                                echo "<option selected value='$id'>$nome</option>";
                            }else {
                                echo "<option value='$id'>$nome</option>";
                            }
                        }
                    }
                    else{
                        echo "<option>Ocorreu um erro no servidor..</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sl_stats">Estado</label>
                <select class="form-control form-control-lg rounded-0" name="sl_status" id="sl_status">
                    <?php if($status == 1){?>
                        <option selected value="1" >Ativa</option>
                        <option value="0" >Inativa</option>
                    <?php }else{?>
                        <option value="1" >Ativa</option>
                        <option selected value="0" selected>Inativa</option>
                    <?php }?>
                </select>
            </div>
            <button type="submit" name="btnconcluir" class="btn btn-success">Concluir</button>
            <?php
            if(isset($_POST["btnconcluir"])){
                if(empty($_POST["lb_c_policia1"])){
                    echo  '<script> swal("Error", "Tem de escrever o policia nº1!", "error")</script>';
                }elseif(empty($_POST["lb_c_policia2"])){
                    echo  '<script> swal("Error", "Tem de escrever o policia nº2!", "error")</script>';
                }elseif(empty($_POST["sl_zona"])){
                    echo  '<script> swal("Error", "Tem de selecionar a zona de patrulhamento!", "error")</script>';
                }elseif(empty($_POST["sl_status"]) && $_POST["sl_status"] != 0){
                    //echo $_POST["sl_status"];
                    echo  '<script> swal("Error", "Tem de selecionar o estado!", "error")</script>';
                }else{
                    $policia_1 = $users->quote($_POST["lb_c_policia1"]);
                    $policia_2 = $users->quote($_POST["lb_c_policia2"]);
                    $zona = $users->quote($_POST["sl_zona"]);
                    $status = $users->quote($_POST["sl_status"]);

                    $patrulha->UpdatePatrulha($Id,$policia_1,$policia_2,$zona,$status);
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
