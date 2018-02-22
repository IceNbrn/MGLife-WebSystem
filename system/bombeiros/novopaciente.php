<!DOCTYPE html>
<html lang="pt">
<?php
ob_start();
session_start();
require_once ("../../system/classes/patrulha.php");
require_once ("../../system/classes/users.php");
require_once ("../../system/classes/bombeiros.php");
$users = new users();
$patrulha = new patrulha();
$bombeiros = new bombeiros();

if($users->IsLogged($_SESSION["userId"])){
    $userIdLogado = $_SESSION["userId"];
    if($users->GetBombeiroLvl(0,$userIdLogado) == 0){
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

    <title>MGLife | Bombeiros Dashboard</title>

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
    <div class="card rounded-0">
        <div class="card-header">
            <h3 class="mb-0">Novo Paciente</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" id="formLogin" method="post" action="novopaciente.php">
                <div class="form-group">
                    <label for="lb_doente">Nome do Doente</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_doente" id="lb_doente">
                </div>
                <div class="form-group">
                    <label>Local da Ocorrência</label>
                    <select class="form-control form-control-lg rounded-0" name="sl_local" id="sl_local">
                        <option value='1'>Auto-Estrada</option>
                        <option value='2'>Estrada</option>
                        <option value='3'>Via Urbana</option>
                        <option value='4'>Recintos Públicos</option>
                        <option value='5'>Local de Trabalho</option>
                        <option value='6'>Domicilio</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Motivo da Chamada</label>
                    <select class="form-control form-control-lg rounded-0" name="sl_motivo" id="sl_motivo">
                        <option value='1'>Acidente</option>
                        <option value='2'>Atropelamento</option>
                        <option value='3'>Agressão</option>
                        <option value='4'>Afogamento</option>
                        <option value='5'>Queda</option>
                        <option value='6'>Incêndio</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Houve transporte?</label><br/>
                    <input type="radio" name="transporte" id="t_sim" value="2" onclick="SetChecked(1)"> Sim<br>
                    <input type="radio" name="transporte" id="t_nao" value="1" onclick="SetChecked(0)"> Não<br>
                </div>
                <div class="form-group">
                    <label>Não houve transporte</label>
                    <select class="form-control form-control-lg rounded-0" name="sl_stransporte" id="sl_stransporte">
                        <option value='1'>Chamada Falsa</option>
                        <option value='2'>Morte</option>
                        <option value='3'>Recusa pela Vitima</option>
                        <option value='4'>Vitima transportada por outro veículo</option>
                    </select>
                </div>
                <button type="submit" name="btnconcluir" class="btn btn-success btn-lg float-right">Concluir</button>

                <?php
                if(isset($_POST["btnconcluir"])){
                    if(empty($_POST["lb_doente"])){
                        echo  '<script> swal("Error", "Tem de escrever o nome do doente!", "error")</script>';
                    }elseif(empty($_POST["sl_local"])){
                        echo  '<script> swal("Error", "Tem de selecionar o local!", "error")</script>';
                    }elseif(empty($_POST["sl_motivo"])){
                        echo  '<script> swal("Error", "Tem de selecionar o motivo!", "error")</script>';
                    }elseif(empty($_POST["transporte"])){
                        echo  '<script> swal("Error", "Tem de selecionar se houve transporte ou não!", "error")</script>';
                    }elseif(empty($_POST["sl_stransporte"]) && ($_POST["transporte"] == 0)){
                        echo  '<script> swal("Error", "Tem de selecionar porque não houve transporte!", "error")</script>';
                    }else{
                        $bombeiro = $userIdLogado;
                        $nomedoente = $users->quote($_POST["lb_doente"]);
                        $sl_local = $users->quote($_POST["sl_local"]);
                        $sl_motivo = $users->quote($_POST["sl_motivo"]);
                        if(empty($_POST["sl_stransporte"])){
                            $sl_transporte = null;
                        }else{
                            $sl_transporte = $users->quote($_POST["sl_stransporte"]);
                        }

                        $bombeiros->AddPaciente($nomedoente,$sl_local,$sl_motivo,$sl_transporte,$bombeiro);
                    }
                }
                ?>
            </form>
        </div>
        <!--/card-block-->
    </div>
</div>
<script src="../../js/paciente.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
