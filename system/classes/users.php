<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 11/02/2018
 * Time: 21:15
 */
require_once "database.php";


class users extends database{


    public function GetUsername($id) : string {
        $sql = "SELECT * FROM users WHERE id = $id";

        $result = $this->query($sql);
        $num_rows = $result->num_rows;
        if($num_rows > 0){
            while($row = $result->fetch_assoc()){
                return $row["username"];
            }
        }
        return null;
    }

    public function Login($username,$password){
        $password = sha1(md5($password));
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

        $result = $this->query($sql);
        $num_rows = $result->num_rows;
        if($num_rows > 0){
            $userData = $result->fetch_array();
            $userid = $userData["id"];
            $deleted = $userData["deleted"];
            if($deleted){
                echo "<script>swal('Oops!', 'A conta foi eliminada!', 'error');</script>";
            }else{
                session_start();
                $_SESSION["userId"] = $userid;

                header("Location: index.php");
            }
        }
    }
    public function CreateUser($username,$password,$steamid){
        $sql = "INSERT INTO users (username,password,deleted,steamid) VALUES ('$username','$password',0,'$steamid')";
        $this->query($sql);
        //echo $sql;
        echo  '<script> swal("Adicionado", "Utilizador criado com sucesso!", "success")</script>';
    }
    public function EditUser($userid,$newusername,$newpassword,$newsteamid,$deleted){
        $sql = "UPDATE users SET username = '$newusername', password = '$newpassword', steamid = '$newsteamid', deleted = '$deleted' WHERE id = $userid";
        $this->query($sql);
        //echo $sql;
        echo  '<script> swal("Sucesso", "Utilizador editado com sucesso!", "success")</script>';
    }
    public function GetCopLvl($steamid){
        $sql = "SELECT * FROM players WHERE pid = $steamid";
        $result = $this->query($sql);

        $num_rows = $result->num_rows;
        if($num_rows > 0){
            while ($row = $result->fetch_assoc()){
                return $row["coplevel"];
            }
        }
        return 0;
    }
    public function GetUserSteamid($id){
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $this->query($sql);

        $num_rows = $result->num_rows;
        if($num_rows > 0){
            while ($row = $result->fetch_assoc()){
                return $row["steamid"];
            }
        }
        return 0;
    }
    public function GetUsernameSession($id){
        echo $this->GetUsername($id);
    }
}