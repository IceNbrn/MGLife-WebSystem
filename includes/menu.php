<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 09/02/2018
 * Time: 12:45
 */
//require_once ("../system/classes/users.php");
$users = new users();

$filename = basename($_SERVER["PHP_SELF"]);
$diretory = str_replace("/".$filename,"",str_replace("/OpenYourGame/","",$_SERVER["PHP_SELF"]));
if($diretory == "/mgrp/system/gnr"){
    $indexDiretory = "../../index.php";
    $loginDirectory = "../../login.php";
    $patrulhaGNRDirectory = "index.php";
    $logoutDirectory = "../../logout.php";
    $logoDirectory = "../../images/mgrplogo.png";
    $adminPainelDirectory = "../admin/painel.php";
    $createPatrulhaDirectory = "../admin/CreateZona.php";
    $irpatrulhaDirectory = "patrulhar.php";
}elseif($diretory == "/mgrp") {
    $indexDiretory = "index.php";
    $loginDirectory = "login.php";
    $logoutDirectory = "logout.php";
    $patrulhaGNRDirectory = "system/gnr/index.php";
    $logoDirectory = "images/mgrplogo.png";
    $adminPainelDirectory = "system/admin/painel.php";
    $createPatrulhaDirectory = "system/admin/CreateZona.php";
    $irpatrulhaDirectory = "system/gnr/patrulhar.php";
}elseif($diretory == "/mgrp/system/admin"){
    $indexDiretory = "../../index.php";
    $loginDirectory = "../../login.php";
    $patrulhaGNRDirectory = "../gnr/index.php";
    $logoutDirectory = "../../logout.php";
    $logoDirectory = "../../images/mgrplogo.png";
    $adminPainelDirectory = "painel.php";
    $createPatrulhaDirectory = "CreateZona.php";
    $irpatrulhaDirectory = "../gnr/patrulhar.php";
}else{
    $indexDiretory = "index.php";
    $loginDirectory = "login.php";
    $patrulhaGNRDirectory = "system/gnr/index.php";
    $logoutDirectory = "logout.php";
    $logoDirectory = "images/mgrplogo.png";
    $adminPainelDirectory = "system/admin/painel.php";
    $createPatrulhaDirectory = "system/admin/CreateZona.php";
    $irpatrulhaDirectory = "system/gnr/patrulhar.php";
    echo $diretory;
}
?>

   <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
          <img src="<?=$logoDirectory?>" width="32px" height="32px">
        <a class="navbar-brand" href="<?=$indexDiretory?>">MGLife System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          <?php
          if(isset($_SESSION["userId"])){?>
              <?php if($users->GetCopLvl($users->GetUserSteamid($_SESSION["userId"])) > 0){ ?>
              <div class="dropdown">
                  <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      GNR Dashboard
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?=$irpatrulhaDirectory?>">Patrulhar</a>
                      <a class="dropdown-item" href="<?=$patrulhaGNRDirectory?>">Patrulhas</a>
                      <a class="dropdown-item" href="#">Report</a>
                      <!--<a class="dropdown-item" href="#">Something else here</a>-->
                  </div>
              </div>
              <?php }?>
              &nbsp
              <div class="dropdown">
                  <button class="btn btn-basic dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Admin Dashboard
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?=$adminPainelDirectory?>">Painel</a>
                      <a class="dropdown-item" href="<?=$createPatrulhaDirectory?>">Nova Patrulha</a>
                      <!--<a class="dropdown-item" href="#">Something else here</a>-->
                  </div>
              </div>
          <?php }?>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"> sad</a>
            </li>
          <div class="dropdown">
              <?php
              if(isset($_SESSION["userId"])){?>
                  <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" href="<?=$loginDirectory?>"><?=$users->GetUsernameSession($_SESSION["userId"])?></a>
              <?php }else{?>

                  <a class="nav-link" href="<?=$loginDirectory?>">Login</a>
              <?php } ?>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="<?=$logoutDirectory?>">Logout</a>
                  <!--<a class="dropdown-item" href="#">Something else here</a>-->
              </div>
          </div>

          </ul>
        </div>
      </div>
    </nav>