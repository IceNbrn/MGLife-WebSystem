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
}