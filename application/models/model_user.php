<?php


class Model_user extends Model
{
    public function isAuthorizedUser($login, $password){
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * "
            . "FROM users WHERE login = :login";
        $st = $conn->prepare($sql);
        $st->bindValue(":login", $login, PDO::PARAM_STR);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if($row){
            if(password_verify($password, $row['password'])){
                return true;
            }else{
                return false;
            }
        }else {
            return false;
        }
    }

    public function getUserData($login){
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * "
            . "FROM users WHERE login = :login";
        $st = $conn->prepare($sql);
        $st->bindValue(":login", $login, PDO::PARAM_STR);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        return $row;
    }
}