<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 13/02/2018
 * Time: 00:00
 */
require_once "database.php";


class bombeiros extends database{

    public function AddPaciente($doente,$localocorrencia,$motivochamada,$naohouvetransporte,$bombeiro){
        if($naohouvetransporte == null){
            $naohouvetransporte = -1;
        }
        $sql = "INSERT INTO doentes (doente,localocorrencia,motivochamada,naohouvetransporte,bombeiro) VALUES ('$doente','$localocorrencia','$motivochamada','$naohouvetransporte','$bombeiro')";
        $this->query($sql);
        echo  '<script> swal("Paciente", "Paciente adicionado com sucesso!", "success")</script>';

    }
    public function GetStringLocal($id){
        switch ($id){
            case 1:
                return "Auto-Estrada";
            case 2:
                return "Estrada";
            case 3:
                return "Via Urbana";
            case 4:
                return "Recintos Públicos";
            case 5:
                return "Local de Trabalho";
            case 6:
                return "Domicilio";
            default:
                return "Null";
        }
    }
    /*
     * <option value='1'></option>
                        <option value='2'></option>
                        <option value='3'></option>
                        <option value='4'></option>
                        <option value='5'></option>
                        <option value='6'></option>
     */
    public function GetStringMotivo($id){
        switch ($id){
            case 1:
                return "Acidente";
            case 2:
                return "Atropelamento";
            case 3:
                return "Agressão";
            case 4:
                return "Afogamento";
            case 5:
                return "Queda";
            case 6:
                return "Incêndio";
            default:
                return "Null";
        }
    }
    public function GetStringNaoHouveTransporte($id){

    }

}