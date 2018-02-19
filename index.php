<!DOCTYPE html>
<html lang="en">
<?php
ob_start();
session_start();
require_once ("system/classes/users.php");
$users = new users();
?>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MGRP | Home</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
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

    <?php include_once "includes/menu.php" ?>
    <header class="bg-primary text-white" style="height: 200px; background-color:#1e1e1e !important;">
        <div class="container text-center" style="padding-top: 25px;">
            <h1>Bem vindo ao MegaGeneration!</h1>
            <p class="lead">Uma comunidade sempre à frente.</p>
        </div>
    </header>
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">A Bootstrap 4 Starter Template</h1>
            <h1 class="mt-5">A Bootstrap 4 Starter Template</h1>
            <h1 class="mt-5">A Bootstrap 4 Starter Template</h1>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?=require_once ("includes/footer.php")?>
  </body>

</html>
