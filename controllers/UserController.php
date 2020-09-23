<?php

class UserController
{
    public function actionLogin()
    {
        $login = false;
        $password = false;
        
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $error = false;
            $userId = User::checkUserData($login, $password);
            if ($userId == false) {
                $error = 'Неправильные данные для входа на сайт';
            } else {
                User::auth($userId);
                header("Location: /requests");
            }
        }

        require_once(ROOT . '/views/login.php');
        return true;
    }

    public function actionLogout()
    {
        unset($_SESSION["user"]);
        header("Location: /");
    }

   

}
