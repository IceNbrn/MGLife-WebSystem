<!DOCTYPE html>
<html lang="pt">
<?php
//TODO: CHECK IF SESSION IS SET AND IF IS GNR
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
    if($users->GetCopLvl(0,$userIdLogado) == 0){
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
    <h2>Pacientes</h2>
    <a href="novopaciente.php" class="btn btn-success" type="button" >
        Novo Paciente
    </a>
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th class="col-md-1">ID</th>
            <th class="col-md-2">Doente</th>
            <th class="col-md-2">Local da Ocorrência</th>
            <th class="col-md-3">Motivo da Chamada</th>
            <th class="col-md-1">Houve/Não houve transporte</th>
            <th class="col-md-4">Bombeiro</th>
            <th class="col-md-2">Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM doentes ORDER BY id DESC";
        $doentes = $users->query($sql);
        $doentes_result_num_rows = $doentes->num_rows;
        if($doentes_result_num_rows > 0){
            while ($row = $doentes->fetch_assoc()){
                $ID = $row["id"];
                $doente = $row["doente"];
                $localocorrencia= $bombeiros->GetStringLocal($row["localocorrencia"]);
                $motivochamada = $bombeiros->GetStringMotivo($row["motivochamada"]);

                ?>
                <tr>

                    <td><?= $ID?></td>
                    <td><?= $doente?></td>
                    <td><?= $localocorrencia?></td>
                    <td><?= $motivochamada?></td>

                </tr>
            <?php }}else{
            echo "Nenhuma patrulha adicionada!";
        }?>
        </tbody>
    </table>
</div>

<!-- Bootstrap core JavaScript -->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?=require_once ("includes/footer.php")?>
</body>

</html>
