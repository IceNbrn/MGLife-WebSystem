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
    $sobreDirectory = "../../sobre.php";

    $logoutDirectory = "../../logout.php";
    $logoDirectory = "../../images/mgrplogo.png";
    //ADMIN
    $adminPainelDirectory = "../admin/painel.php";
    $createPatrulhaDirectory = "../admin/CreateZona.php";
    //GNR
    $patrulhaGNRDirectory = "index.php";
    $irpatrulhaDirectory = "patrulhar.php";
    $reportpGNRDirectory = "fugitivos.php";
    $reportvGNRDirectory = "veiculos.php";
    $pacientesDirectory = "../bombeiros/index.php";
    $novopacienteDirectory = "../bombeiros/novopaciente.php";
}elseif($diretory == "/mgrp") {
    //HOME
    $indexDiretory = "index.php";
    $loginDirectory = "login.php";
    $logoutDirectory = "logout.php";
    $sobreDirectory = "sobre.php";

    $logoDirectory = "images/mgrplogo.png";
    //ADMIN
    $adminPainelDirectory = "system/admin/painel.php";
    $createPatrulhaDirectory = "system/admin/CreateZona.php";
    //GNR
    $reportpGNRDirectory = "system/gnr/fugitivos.php";
    $reportvGNRDirectory = "system/gnr/veiculos.php";
    $irpatrulhaDirectory = "system/gnr/patrulhar.php";
    $patrulhaGNRDirectory = "system/gnr/index.php";
    //BOMBEIROS
    $pacientesDirectory = "system/bombeiros/index.php";
    $novopacienteDirectory = "system/bombeiros/novopaciente.php";
}elseif($diretory == "/mgrp/system/admin"){
    //ADMIN
    $adminPainelDirectory = "painel.php";
    $createPatrulhaDirectory = "CreateZona.php";
    //HOME
    $indexDiretory = "../../index.php";
    $loginDirectory = "../../login.php";
    $logoutDirectory = "../../logout.php";
    $logoDirectory = "../../images/mgrplogo.png";
    $sobreDirectory = "../../sobre.php";

    //GNR
    $patrulhaGNRDirectory = "../gnr/index.php";
    $irpatrulhaDirectory = "../gnr/patrulhar.php";
    $reportpGNRDirectory = "../gnr/fugitivos.php";
    $reportvGNRDirectory = "../gnr/veiculos.php";
    //BOMBEIROS
    $pacientesDirectory = "../bombeiros/index.php";
    $novopacienteDirectory = "../bombeiros/novopaciente.php";
}elseif($diretory == "/mgrp/system/bombeiros"){
    //BOMBEIROS
    $pacientesDirectory = "index.php";
    $novopacienteDirectory = "novopaciente.php";
    //ADMIN
    $adminPainelDirectory = "../admin/painel.php";
    $createPatrulhaDirectory = "../admin/CreateZona.php";
    //HOME
    $indexDiretory = "../../index.php";
    $loginDirectory = "../../login.php";
    $logoutDirectory = "../../logout.php";
    $logoDirectory = "../../images/mgrplogo.png";
    $sobreDirectory = "../../sobre.php";

    //GNR
    $patrulhaGNRDirectory = "../gnr/index.php";
    $irpatrulhaDirectory = "../gnr/patrulhar.php";
    $reportpGNRDirectory = "../gnr/fugitivos.php";
    $reportvGNRDirectory = "../gnr/veiculos.php";
}else{
    $indexDiretory = "index.php";
    $loginDirectory = "login.php";
    $sobreDirectory = "sobre.php";
    //GNR
    $patrulhaGNRDirectory = "system/gnr/index.php";
    $reportpGNRDirectory = "system/gnr/fugitivos.php";
    $reportvGNRDirectory = "system/gnr/veiculos.php";
    $irpatrulhaDirectory = "system/gnr/patrulhar.php";
    $logoutDirectory = "logout.php";
    $logoDirectory = "images/mgrplogo.png";
    //admin
    $adminPainelDirectory = "system/admin/painel.php";
    $createPatrulhaDirectory = "system/admin/CreateZona.php";
    //BOMBEIROS
    $pacientesDirectory = "system/bombeiros/index.php";
    $novopacienteDirectory = "system/bombeiros/novopaciente.php";

    echo $diretory;
}
?>

   <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
          <img src="<?=$logoDirectory?>" width="32px" height="32px">
        <a class="navbar-brand" href="<?=$indexDiretory?>">MGLife</a>
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
                      <a class="dropdown-item" href="<?=$patrulhaGNRDirectory?>">Patrulhas</a>
                      <a class="dropdown-item" href="<?=$reportpGNRDirectory?>">Fugitivos</a>
                      <a class="dropdown-item" href="<?=$reportvGNRDirectory?>">Veiculos Procurados</a>
                      <!--<a class="dropdown-item" href="#">Something else here</a>-->
                  </div>
              </div>
              <?php }?>
              &nbsp
              <?php if($users->GetBombeiroLvl($users->GetUserSteamid($_SESSION["userId"])) > 0){ ?>
                  <div class="dropdown">
                      <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Bombeiros Dashboard
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="<?=$pacientesDirectory?>">Pacientes</a>
                          <!--<a class="dropdown-item" href="#">Something else here</a>-->
                      </div>
                  </div>
              <?php }?>
              &nbsp
              <?php if($users->GetAdminLvl($users->GetUserSteamid($_SESSION["userId"])) > 0){ ?>
              <div class="dropdown">
                  <button class="btn btn-basic dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Admin Dashboard
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="<?=$adminPainelDirectory?>">Painel</a>
                      <a class="dropdown-item" href="<?=$createPatrulhaDirectory?>">Nova Zona</a>
                      <!--<a class="dropdown-item" href="#">Something else here</a>-->
                  </div>
              </div>
              <?php }?>
          <?php }?>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=$sobreDirectory?>">Sobre</a>
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