<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 13/02/2018
 * Time: 00:00
 */
require_once "database.php";


class patrulha extends database{

    public function NewZona($zona){
        $sql = "INSERT INTO listapatrulhas (zona) VALUES ('$zona')";
        $this->query($sql);
        //echo $sql;
        echo  '<script> swal("Adicionado", "Zona de patrulhamento adicionada!", "success")</script>';
    }
    public function NewPatrulha($policia1,$policia2,$zona,$status){
        if($policia2 == null)
            $policia2 = "---";
        $sql = "INSERT INTO patrulhas (policia,policia2,zona,status) VALUES ('$policia1','$policia2','$zona','$status')";
        $this->query($sql);
        //echo $sql;
        echo  '<script> swal("Criada", "Nova patrulha adicionada com sucesso!", "success")</script>';
    }
    public function PatrulhaExists($policia1,$policia2,$zona,$status) : bool {
        $sql = "SELECT * FROM patrulhas WHERE policia = '$policia1' OR policia2 = '$policia1' OR policia2 = '$policia2' OR policia = '$policia1'";
        $result = $this->query($sql);

        $num_rows = $result->num_rows;

        if($num_rows > 0){
            return true;
        }
        return false;
    }
    public function PoliciasNumaZona($zona) : int{
        $sql = "SELECT COUNT(zona) as npolicias FROM patrulhas WHERE zona = '$zona' AND status = 1";
        $result = $this->query($sql);
        $num_rows = $result->num_rows;
        if($num_rows > 0){
            $data = $result->fetch_assoc();
            return $data["npolicias"];
        }
        return 0;
    }
    public function UpdatePatrulha($idPatrulha,$policia1,$policia2,$zona,$status){
        $policiasnumazona = $this->PoliciasNumaZona($zona);
        if($policia2 != "---"){
            $sql = "SELECT * FROM patrulhas WHERE policia = '$policia2' OR policia2 = '$policia2'";
            $result = $this->query($sql);
            $num_rows = $result->num_rows;

            if($num_rows > 0){
                echo  '<script> swal("Patrulha", "O policia nº2 já está numa patrulha!", "error")</script>';
            }else{
                if($policiasnumazona < 2) {
                    $sql = "UPDATE patrulhas SET policia2 = '$policia2', status = '$status', zona = '$zona',last_modification = current_timestamp() WHERE id = $idPatrulha";
                    $this->query($sql);
                    echo  '<script> swal("Patrulha", "Patrulha atualizada com sucesso!", "success")</script>';
                }else{
                    echo  '<script> swal("Patrulha", "Já existe policias suficientes nessa zona!", "error")</script>';
                }
            }
        }else{
            if($policiasnumazona < 2){
                $sql1 = "UPDATE patrulhas SET status = '$status', zona = '$zona',last_modification = current_timestamp() WHERE id = $idPatrulha";
                $this->query($sql1);
                echo  '<script> swal("Patrulha", "Patrulha atualizada com sucesso!", "success")</script>';
            }else{
                echo  '<script> swal("Patrulha", "Já existe policias suficientes nessa zona!", "error")</script>';
            }
        }

    }

    public function GetZona($id) : string {
        $sql = "SELECT * FROM listapatrulhas WHERE id = '$id'";
        $result = $this->query($sql);

        $num_rows = $result->num_rows;

        if($num_rows > 0){
            while ($row = $result->fetch_assoc()){
                return $row["zona"];
            }
        }
        return "";
    }
    public function SairDaPatrulha($idPatrulha,$policia){
        $sql = "UPDATE patrulhas SET policia2 = '---' WHERE id = '$idPatrulha' AND policia2 = '$policia'";
        $this->query($sql);
        echo  "<script>
        swal('Saiste da patrulha com sucesso!').then((value) => {
            location.href = 'index.php';
        });
        </script>";
    }
    public function SetColor($value){
        if($value == "Ativa"){
            echo 'style="color: #42d600"';
        }else{
            echo 'style="color: #ff2c00"';
        }
    }
}