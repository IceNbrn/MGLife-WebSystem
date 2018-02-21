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
    /*public function AddPatrulha($policia1,$policia2,$zona,$status){
        if($policia2 == null)
            $policia2 = "---";
        $sql = "INSERT INTO patrulhas (policia,policia2,zona,status) VALUES ('$policia1','$policia2','$zona','$status')";
        $this->query($sql);
        //echo $sql;
        echo  '<script> swal("Criada", "Nova patrulha adicionada com sucesso!", "success")</script>';
    }*/
    public function AddPatrulha($policia1,$policia2,$zona,$status){
        $sql0 = "SELECT * FROM patrulhas WHERE  policia = '$policia1' OR policia2 = '$policia1'";
        $result = $this->query($sql0);
        $num_rows = $result->num_rows;
        if($num_rows > 0){
            echo  '<script> swal("Patrulha", "Desculpa mas já estás noutra patrulha, edita o estado da patrulha para ativa!", "error")</script>';
            exit;
        }
        $policiasnumazona = $this->PoliciasNumaZona($zona);
        if($policia2 != "---"){
            $sql = "SELECT * FROM patrulhas WHERE policia = '$policia2' OR policia2 = '$policia2'";
            $result = $this->query($sql);
            $num_rows = $result->num_rows;

            if($num_rows > 0){
                echo  '<script> swal("Patrulha", "O policia nº2 já está numa patrulha!", "error")</script>';
            }else{
                if($policiasnumazona < 2) {
                    $sql = "INSERT INTO patrulhas (policia,policia2,zona,status) VALUES ('$policia1','$policia2','$zona','$status')";
                    $this->query($sql);
                    echo  '<script> swal("Patrulha", "Patrulha criada com sucesso!", "success")</script>';
                }else{
                    echo  '<script> swal("Patrulha", "Já existe policias suficientes nessa zona!", "error")</script>';
                }
            }
        }else{
            if($policiasnumazona < 2){
                $sql1 = "INSERT INTO patrulhas (policia,policia2,zona,status) VALUES ('$policia1','$policia2','$zona','$status')";
                $this->query($sql1);
                echo  '<script> swal("Patrulha", "Patrulha criada com sucesso!", "success")</script>';
            }else{
                echo  '<script> swal("Patrulha", "Já existe policias suficientes nessa zona!", "error")</script>';
            }
        }

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
    public function UpdateFugitivo($id,$status){
        $sql = "UPDATE reportpessoa SET status = '$status' WHERE id = $id";
        $this->query($sql);
        echo  '<script> swal("Report", "O estado do fugitivo foi atualizado com sucesso!", "success")</script>';
    }
    public function UpdateVeiculo($id,$status){
        $sql = "UPDATE reportv SET status = '$status' WHERE id = $id";
        $this->query($sql);
        echo  '<script> swal("Report", "O estado do veiculo foi atualizado com sucesso!", "success")</script>';
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
    public function AddReportP($fugitivo,$ultimavezvisto,$lultimavezvisto,$policia_servico,$descricao,$motivo){
        if($fugitivo == null)
            $fugitivo = "---";
        $sql = "INSERT INTO reportpessoa (fugitivo,ultimavezvisto,localultimavezvisto,policia_servico,descricao,motivo) VALUES ('$fugitivo','$ultimavezvisto','$lultimavezvisto','$policia_servico','$descricao','$motivo')";
        $this->query($sql);
        //echo $sql;
        echo  '<script> swal("Report", "Novo suspeito adicionado com sucesso!", "success")</script>';
    }
    public function AddReportV($tipo_veiculo,$marca,$cor,$proprietario,$localultimavezvisto,$motivo,$policia_servico){
        if($marca == null)
            $marca = "---";
        if($proprietario == null)
            $proprietario = "---";
        $sql = "INSERT INTO reportv (tipo_veiculo,marca,cor,proprietario,localultimavezvisto,motivo,policia_servico) VALUES ('$tipo_veiculo','$marca','$cor','$proprietario','$localultimavezvisto','$motivo','$policia_servico')";
        $this->query($sql);
        //echo $sql;
        echo  '<script> swal("Report", "Novo veiculo adicionado com sucesso!", "success")</script>';
    }
    public function SetColor($value){
        if($value == "Ativa" || $value == "Encontrado"){
            echo 'style="color: #42d600"';
        }else{
            echo 'style="color: #ff2c00"';
        }
    }
    public function GetStatus($value) : string{
        if($value == 1)
            return "Procurado";
        else
            return "Encontrado";
    }
}