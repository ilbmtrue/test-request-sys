<?php

class user
{
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }
    public static function checkUserData($login, $password)
    {
        $db = Db::getConnection();
        $query = 'SELECT * FROM users WHERE employee = :login AND password = :password';
        $login = trim(htmlspecialchars($login));
        $password = md5(trim(htmlspecialchars($password)));

        $result = $db->prepare($query);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {  
            return $user['id'];
        }
        return false;
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }
    public static function checkLogged()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }



}
