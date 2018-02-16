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
    <h2>Hoverable Dark Table</h2>
    <p>The .table-hover class adds a hover effect (grey background color) on table rows:</p>
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th class="col-md-1">ID</th>
            <th class="col-md-2">Polícia nº1</th>
            <th class="col-md-2">Polícia nº2</th>
            <th class="col-md-3">Zona</th>
            <th class="col-md-1">Estado</th>
            <th class="col-md-4">Ultima Modificação</th>
            <th class="col-md-2">Opções</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM patrulhas ORDER BY last_modification DESC";
        $users_result = $users->query($sql);
        $users_result_num_rows = $users_result->num_rows;
        if($users_result_num_rows > 0){
            while ($row = $users_result->fetch_assoc()){
                $patrulhaID = $row["id"];
                $policia1 = $row["policia"];
                $policia2 = $row["policia2"];
                $zona = $patrulha->GetZona($row["zona"]);
                if($row["status"] == 0)
                    $estado = "Inativa";
                else
                    $estado = "Ativa";

                $ultima_modificacao = $row["last_modification"];
                ?>
                <tr>

                    <td><?= $patrulhaID?></td>
                    <td><?= $policia1?></td>
                    <td><?= $policia2?></td>
                    <td><?= $zona?></td>
                    <td <?=$patrulha->SetColor($estado);?> ><?= $estado?></td>
                    <td><?= $ultima_modificacao?></td>
                    <th><a class="btn btn-secondary" href="EditUser.php?id=<?=$patrulhaID?>" target="_blank">Atualizar Patrulha</a></th>
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

</body>

</html>
