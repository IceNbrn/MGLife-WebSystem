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
    <p>Report de uma pessoa:</p>
    <div class="card rounded-0">
        <div class="card-header">
            <h3 class="mb-0">Report Pessoa</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" id="formLogin" method="post" action="reportp.php">
                <div class="form-group">
                    <label for="lb_n_fugitivo">Nome do fugitivo (Opcional)</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_n_fugitivo" id="lb_n_fugitivo">
                </div>
                <div class="form-group">
                    <label for="lb_descricao">Descrição</label>
                    <textarea type="text" class="form-control form-control-lg rounded-0" name="lb_descricao" id="lb_descricao"></textarea>
                </div>
                <div class="form-group">
                    <label for="lb_motivo">Motivo</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_motivo" id="lb_motivo">
                </div>
                <div class="form-group">
                    <label for="lb_ultimavezvisto">Ultima Vez Visto</label>
                    <input type="text" placeholder="dia/mês/ano hora:minutos" class="form-control form-control-lg rounded-0" name="lb_ultimavezvisto" id="lb_ultimavezvisto">
                </div>
                <div class="form-group">
                    <label for="lb_lultimavezvisto">Local Ultima Vez Visto</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_lultimavezvisto" id="lb_lultimavezvisto">
                </div>
                <button type="submit" name="btnconcluir" class="btn btn-success btn-lg float-right">Concluir</button>

                <?php
                if(isset($_POST["btnconcluir"])){
                    if(empty($_POST["lb_descricao"])){
                        echo  '<script> swal("Error", "Tem escrever uma descrição!", "error")</script>';
                    }elseif(empty($_POST["lb_ultimavezvisto"])){
                        echo  '<script> swal("Error", "Tem de escreve uma data/hora da ultima posição visto!", "error")</script>';
                    }elseif(empty($_POST["lb_lultimavezvisto"])){
                        echo  '<script> swal("Error", "Tem de escrever o local da ultima vez visto!", "error")</script>';
                    }elseif(empty($_POST["lb_motivo"])){
                        echo  '<script> swal("Error", "Tem de escrever um motivo!", "error")</script>';
                    }else{

                        if(empty($_POST["lb_n_fugitivo"])){
                            $fugitivo = null;
                        }else{
                            $fugitivo = $users->quote($_POST["lb_n_fugitivo"]);
                        }
                        $policia_servico = $_SESSION["userId"];
                        $descricao = $users->quote($_POST["lb_descricao"]);
                        $ultimavezvisto = $users->quote($_POST["lb_ultimavezvisto"]);
                        $lultimavezvisto = $users->quote($_POST["lb_lultimavezvisto"]);
                        $motivo = $users->quote($_POST["lb_motivo"]);
                        $patrulha->AddReportP($fugitivo,$ultimavezvisto,$lultimavezvisto,$policia_servico,$descricao,$motivo);
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
