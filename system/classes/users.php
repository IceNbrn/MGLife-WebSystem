<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 11/02/2018
 * Time: 21:15
 */
require_once "database.php";


class users extends database{

    protected static $connection;

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
    public function GetUsernameSession($id){
        echo $this->GetUsername($id);
    }
}