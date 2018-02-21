<!DOCTYPE html>
<html lang="pt">
<?php
ob_start();
session_start();
require_once ("../../system/classes/patrulha.php");
require_once ("../../system/classes/users.php");
$users = new users();
$patrulha = new patrulha();
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MGLife | GNR Dashboard</title>

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
<div class="container">
    <h2>Preencha os campos abaixos</h2>
    <p>Report de um Veículo:</p>
    <div class="card rounded-0">
        <div class="card-header">
            <h3 class="mb-0">Report Veículo</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" id="formLogin" method="post" action="reportv.php">
                <div class="form-group">
                    <label for="sl_tipo">Tipo de Veículo</label>
                    <select class="form-control form-control-lg rounded-0" name="sl_tipo" id="sl_tipo">
                        <option selected value='0'>Moto</option>
                        <option selected value='1'>Carro</option>
                        <option selected value='2'>Barco</option>
                        <option selected value='3'>Helicóptero</option>
                        <option selected value='4'>Avião</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lb_marca">Marca (Opcional)</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_marca" id="lb_marca">
                </div>
                <div class="form-group">
                    <label for="lb_cor">Cor</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_cor" id="lb_cor">
                </div>
                <div class="form-group">
                    <label for="lb_proprietario">Proprietário (Opcional)</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_proprietario" id="lb_proprietario">
                </div>
                <div class="form-group">
                    <label for="lb_lultimavezvisto">Local Ultima Vez Visto</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_lultimavezvisto" id="lb_lultimavezvisto">
                </div>
                <div class="form-group">
                    <label for="lb_motivo">Motivo</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_motivo" id="lb_motivo">
                </div>
                <button type="submit" name="btnconcluir" class="btn btn-success btn-lg float-right">Concluir</button>

                <?php
                if(isset($_POST["btnconcluir"])){
                    if(empty($_POST["sl_tipo"])){
                        echo  '<script> swal("Error", "Tem selecionar o tipo de veíclo!", "error")</script>';
                    }elseif(empty($_POST["lb_cor"])){
                        echo  '<script> swal("Error", "Tem de escrever a cor!", "error")</script>';
                    }elseif(empty($_POST["lb_lultimavezvisto"])){
                        echo  '<script> swal("Error", "Tem de escrever o local da ultima vez visto!", "error")</script>';
                    }elseif(empty($_POST["lb_motivo"])){
                        echo  '<script> swal("Error", "Tem de escrever um motivo!", "error")</script>';
                    }else{

                        if(empty($_POST["lb_marca"])){
                            $marca = null;
                        }else{
                            $marca = $users->quote($_POST["lb_marca"]);
                        }
                        if(empty($_POST["lb_proprietario"])){
                            $proprietario = null;
                        }else{
                            $proprietario = $users->quote($_POST["lb_proprietario"]);
                        }
                        $policia_servico = $_SESSION["userId"];
                        $tipo = $users->quote($_POST["sl_tipo"]);
                        $cor = $users->quote($_POST["lb_cor"]);
                        $lultimavezvisto = $users->quote($_POST["lb_lultimavezvisto"]);
                        $motivo = $users->quote($_POST["lb_motivo"]);
                        $patrulha->AddReportV($tipo,$marca,$cor,$proprietario,$lultimavezvisto,$motivo,$policia_servico);
                    }
                }
                ?>
            </form>
        </div>
        <!--/card-block-->
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
