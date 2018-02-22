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
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-5 box-shadow">
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="images/gnr.jpg" data-holder-rendered="true">
                        <div class="card-body">
                            <h3 class="card-text text-center">GNR</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="images/tap.jpg" data-holder-rendered="true">
                        <div class="card-body">
                            <h3 class="card-text text-center">TAP</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="images/inem.jpg" data-holder-rendered="true">
                        <div class="card-body">
                            <h3 class="card-text text-center">BOMBEIROS</h3>
                        </div>
                    </div>
                </div>


        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?=require_once ("includes/footer.php")?>
  </body>

</html>
