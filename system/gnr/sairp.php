<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 17/02/2018
 * Time: 14:57
 */
ob_start();
session_start();

require_once ("../../system/classes/patrulha.php");
require_once ("../../system/classes/users.php");

$users = new users();
$patrulha = new patrulha();

if($users->IsLogged($_SESSION["userId"])){
    $userIdLogado = $_SESSION["userId"];
    if($users->GetCopLvl(0,$userIdLogado) == 0){
        header("Location: ../../logout.php");
    }
}else{
    header("Location: ../../login.php");
}

?>
<html>
<head>
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/home.css" rel="stylesheet">
    <script src="../../js/sweetalert.min.js"></script>
</head>
    <body>
        <?php
        if($_GET["id"]){
            $id = $patrulha->quote($_GET["id"]);
            $policia = $users->GetUsername($_SESSION["userId"]);
            $patrulha->SairDaPatrulha($id,$policia);
        }?>
        <script src="../../vendor/jquery/jquery.min.js"></script>
        <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
