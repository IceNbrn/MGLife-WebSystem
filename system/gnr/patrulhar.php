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
    <link href="../../css/home.css" rel="stylesheet">
    <script src="../../js/sweetalert.min.js"></script>
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
    <h2>Preencha os campos abaixos</h2>
    <p>The .table-hover class adds a hover effect (grey background color) on table rows:</p>
    <div class="card rounded-0">
        <div class="card-header">
            <h3 class="mb-0">COP System</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off" id="formLogin" method="post" action="patrulhar.php">
                <div class="form-group">
                    <label for="lb_policia_1">Nome do Polícia nº1</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_policia_1" id="lb_policia_1" value="<?=$users->GetUsernameSession($_SESSION["userId"])?>">
                </div>
                <div class="form-group">
                    <label for="lb_policia_2">Nome do Polícia nº2 (Opcional)</label>
                    <input type="text" class="form-control form-control-lg rounded-0" name="lb_policia_2" id="lb_policia_2">
                </div>
                <div class="form-group">
                    <label>Zona de Patrulhamento</label>
                    <select class="form-control form-control-lg rounded-0" name="sl_zona" id="sl_zona">
                        <?php
                        $sql = "SELECT * FROM listapatrulhas";
                        $categorias = $patrulha->query($sql);
                        if($categorias->num_rows >0){
                            while ($row = $categorias->fetch_assoc()){
                                $nome = $row["zona"];
                                $id = $row["id"];
                                echo "<option value='$id'>$nome</option>";
                            }
                        }
                        else{
                            echo "<option>Ocorreu um erro no servidor..</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select class="form-control form-control-lg rounded-0" name="sl_status" id="sl_status">
                        <option value='1'>Ativa</option>
                        <option value='0'>Inativa</option>
                    </select>
                </div>
                <button type="submit" name="btnpatrulhar" class="btn btn-success btn-lg float-right">Patrulhar</button>

                <?php
                if(isset($_POST["btnpatrulhar"])){
                    if(empty($_POST["lb_policia_1"])){
                        echo  '<script> swal("Error", "Tem de escrever o nome do policia nº1!", "error")</script>';
                    }elseif(empty($_POST["sl_zona"])){
                        echo  '<script> swal("Error", "Tem de selecionar a zona de patrulhamento!", "error")</script>';
                    }elseif(empty($_POST["sl_status"])){
                        echo  '<script> swal("Error", "Tem de selecionar o status da patrulha!", "error")</script>';
                    }else{
                        $policia_1 = $users->quote($_POST["lb_policia_1"]);
                        if(empty($_POST["lb_policia_2"])){
                            $policia_2 = null;
                        }else{
                            $policia_2 = $users->quote($_POST["lb_policia_2"]);
                        }

                        $sl_zona = $users->quote($_POST["sl_zona"]);
                        $sl_status = $users->quote($_POST["sl_status"]);

                        if(!$patrulha->PatrulhaExists($policia_1,$policia_2))
                            $patrulha->NewPatrulha($policia_1,$policia_2,$sl_zona,$sl_status);
                        else
                            echo  '<script> swal("Erro", "Um dos policias adicionados já estão noutra patrulha!", "error")</script>';
                    }
                }
                ?>
            </form>
        </div>
        <!--/card-block-->
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
