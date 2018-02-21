<!DOCTYPE html>
<html lang="pt">
<?php

ob_start();
session_start();
require_once ("../../system/classes/patrulha.php");
require_once ("../../system/classes/users.php");
$users = new users();
$patrulha = new patrulha();

$userIdLogado = $_SESSION["userId"];
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
    <h2>Veiculos Procurado</h2>
    <a href="reportv.php" class="btn btn-success" type="button" >
        Adicionar Veiculo
    </a>
    <br/>
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th class="col-md-1">ID</th>
            <th class="col-md-2">Tipo De Veículo</th>
            <th class="col-md-1">Marca</th>
            <th class="col-md-1">Cor</th>
            <th class="col-md-1">Proprietário</th>
            <th class="col-md-1">Local Ultima Vez Visto</th>
            <th class="col-md-3">Motivo</th>
            <th class="col-md-2">Policia Serviço</th>
            <th class="col-md-2">Estado</th>
            <th class="col-md-2">Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM reportv ORDER BY id DESC";
        $users_result = $users->query($sql);
        $users_result_num_rows = $users_result->num_rows;
        if($users_result_num_rows > 0){
            while ($row = $users_result->fetch_assoc()){
                $ID = $row["id"];
                $tipo_veiculo= $row["tipo_veiculo"];
                $marca = $row["marca"];
                $cor = $row["cor"];
                $policia_servico = $users->GetUsername($row["policia_servico"]);
                $proprietario= $row["proprietario"];
                $motivo = $row["motivo"];
                $localultimavezvisto = $row["localultimavezvisto"];
                $status = $row["status"];
                $status = $patrulha->GetStatus($status);
                ?>
                <tr>

                    <td><?= $ID?></td>
                    <td><?= $tipo_veiculo?></td>
                    <td><?= $marca?></td>
                    <td><?= $cor?></td>
                    <td><?= $proprietario?></td>
                    <td><?= $localultimavezvisto?></td>
                    <td><?= $motivo?></td>
                    <td><?= $policia_servico?></td>
                    <td <?=$patrulha->SetColor($status);?> ><?= $status?></td>
                    <th><a class="btn btn-secondary" href="atualizarv.php?id=<?=$ID?>" target="_blank">Atualizar</a></th>
                </tr>
            <?php }}else{
            echo "Nenhum carro adicionado!";
        }?>
        </tbody>
    </table>
</div>

<!-- Bootstrap core JavaScript -->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
