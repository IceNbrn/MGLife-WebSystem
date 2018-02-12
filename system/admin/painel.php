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
        <p>The .table-hover class adds a hover effect (grey background color) on table rows:</p>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Patente</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
            </tr>
            <tr>
                <td>Mary</td>
                <td>Moe</td>
                <td>mary@example.com</td>
            </tr>
            <tr>
                <td>July</td>
                <td>Dooley</td>
                <td>july@example.com</td>
            </tr>
            </tbody>
        </table>
        <a class="btn btn-secondary" href="EditUser.php">Editar um utilizador</a>
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
