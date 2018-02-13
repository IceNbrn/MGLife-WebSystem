<!DOCTYPE html>
<html lang="pt">
<?php
ob_start();
session_start();
require_once ("../../system/classes/users.php");
$users = new users();
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MGLife | Admin Painel</title>

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
<div class="row">
    <div class="container">
        <h2>Users</h2>
        <p>A tabela abaixo mostra os utilizadores do site que já entraram no servidor!</p>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th class="col-md-1">ID</th>
                <th class="col-md-6">Nome</th>
                <th class="col-md-1">Deleted</th>
                <th class="col-md-2">Opções</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM users,players WHERE users.steamid = players.pid";
            $users_result = $users->query($sql);
            $users_result_num_rows = $users_result->num_rows;
            if($users_result_num_rows > 0){
                while ($row = $users_result->fetch_assoc()){
                    $userID = $row["id"];
                    $username = $row["username"];
                    $deleted = $row["deleted"];
            ?>
            <tr>

                <td><?= $userID?></td>
                <td><?= $username?></td>
                <td><?= $deleted?></td>
                <th><a class="btn btn-secondary" href="EditUser.php?id=<?=$userID?>" target="_blank">Editar um utilizador</a></th>
            </tr>
            <?php }}?>
            </tbody>
        </table>

        <a class="btn btn-success" href="CreateUser.php">Criar um utilizador</a>


    </div>
    <!--<div class="col-md-2">
        <div class="container"></div>
        <h2>Users</h2>
    </div>-->
</div>


<!-- Bootstrap core JavaScript -->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
