<?php

// заглушка для не авторизованных пользователей сделал "в лоб", тк система не большая

class RequestController
{
    public function actionIndex(){
        if(!User::isGuest()){
            $requests = Request::getRequestsList();
            require_once(ROOT . '/views/requests.php');
            return true;
        }
        header("Location: /login");
        return false;
    }
    public function actionIndexFilter(){
        if(!User::isGuest()){
            $params = array();
            parse_str($_SERVER['QUERY_STRING'], $params);
            $requests = Request::getRequestsList($params);
            require_once(ROOT . '/views/requests.php');
            return true;
        } 
        header("Location: /login");
        return false;
        
    }
    public function actionEdit($id){
        if(!User::isGuest()){
            if (isset($_POST['edit'])) {
                Request::updateRequest($id);
            }
            $request = Request::getRequestById($id);
            require_once(ROOT . '/views/request.php');
            return true;
        } 
        header("Location: /login");
        return false;
    }
    public function actionAdd()
    {
        $request_id = Request::addRequest();
        if($request_id){
            require_once(ROOT . '/views/success.php');
        } 
        return true;
    }
    
}

?>