<?php
class RequestController
{
    public function actionIndex(){
        $requests = Request::getRequestsList();
        require_once(ROOT . '/views/requests.php');
        return true;
    }
    public function actionIndexFilter(){
        $params = array();
        parse_str($_SERVER['QUERY_STRING'], $params);
        $requests = Request::getRequestsList($params);
        require_once(ROOT . '/views/requests.php');
        return true;
    }
    public function actionEdit($id){
        if (isset($_POST['edit'])) {
            Request::updateRequest($id);
        }
        $request = Request::getRequestById($id);
        require_once(ROOT . '/views/request.php');
        return true;
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