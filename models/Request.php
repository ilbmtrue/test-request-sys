<?php
    /*
        модель Заявок
    */
    class Request
    {
        public static function addRequest(){
            $db = Db::getConnection();
            $query_col[] = "type";
            switch ($_POST["request_type"]) {
                case '1':
                    $query_val[] = $request_type = "Просьба";
                    break;
                case '2':
                    $query_val[] = $request_type = "Предложение";
                    break;
                case '3':
                    $query_val[] = $request_type = "Отзыв";
                    break;
            }

            $query_col[] = "fio";
            $query_val[] = $fio = trim(htmlspecialchars($_POST["fio"]));
            
            if( !empty($_POST["address"]) ){
                $query_col[] = "address";
                $query_val[] =  $address = trim(htmlspecialchars($_POST["address"]));
            } 
            if( !empty($_POST["phone"]) ){
                $query_col[] = "phone";
                $query_val[] =  $phone = trim(htmlspecialchars($_POST["phone"]));
            } 
            if( !empty($_POST["email"]) ){
                $query_col[] = "email";
                $query_val[] = $email = trim(htmlspecialchars($_POST["email"]));
            } 

            $query_col[] = "msg";
            $query_val[] = $msg = trim(htmlspecialchars($_POST["msg"]));

            $str = implode("`, `", array_diff($query_col, array('')));
            $str2 = implode("', '", array_diff($query_val, array('')));

            $query = "INSERT INTO requests.request (`" . $str . "`) VALUES " . "('" . $str2 . "');";
  
            $result = $db->prepare($query);
            $result->execute();
            if ($id = $db->lastInsertId()) {
                return $id;
            }

            return false;

        }
        public static function updateRequest($id){
            
            $db = Db::getConnection();
            $sql = "UPDATE `requests`.`request`
                SET 
                    type = :type, 
                    fio = :fio, 
                    address = :address, 
                    phone = :phone, 
                    email = :email, 
                    msg = :msg, 
                    timestamp_update = NOW()
                WHERE id = :id";

            $type = self::getInputSelectText($_POST['request_type']);
            
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':type', $type, PDO::PARAM_STR);
            $result->bindParam(':fio', $_POST['fio'], PDO::PARAM_STR);
            $result->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
            $result->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR);
            $result->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $result->bindParam(':msg', $_POST['msg'], PDO::PARAM_STR);

            return $result->execute();

        }

        public static function getRequestsList($params = "")
        {
            if($params){
                $type = self::getInputSelectText($params["type"]);
                $fio = '%'.$params["fio"].'%';
                $limit = ($params["limit"] == 0) ? "" : "LIMIT " . self::getInputSelectLimit($params["limit"]);
                $sort_by = ($params["time"] == 1) ? "ASC": "DESC";
            } else {
                $type = 0;
                $fio = "%";
                $limit = "";
                $sort_by = "ASC";
            }

            $sub_str = "";
            if($type){   
                $sub_str = 'type = :type AND ';
            }          
            $sql = "SELECT * FROM `requests`.`request` WHERE " . $sub_str . "fio LIKE :fio ORDER BY timestamp_update " . $sort_by . " " . $limit . "";

            $db = Db::getConnection();
            $result = $db->prepare($sql);
            if($type){   
                $result->bindParam(':type', $type, PDO::PARAM_STR);
            }
            $result->bindParam(':fio', $fio, PDO::PARAM_STR);         
            $result->execute();

            // var_dump($result->debugDumpParams()); // дамп PDO

            $requestList = array();
            $i = 0; 
            while ($row = $result->fetch()){
                $requestList[$i]['id'] = $row['id'];
                $requestList[$i]['type'] = $row['type'];
                $requestList[$i]['fio'] = $row['fio'];
                $requestList[$i]['address'] = $row['address'];
                $requestList[$i]['phone'] = $row['phone'];
                $requestList[$i]['email'] = $row['email'];
                $requestList[$i]['timestamp_update'] = $row['timestamp_update'];
                $i++;
            }
      
            return $requestList;

        }

        public static function getRequestById($id)
        {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM requests.request WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }

        public static function getInputSelectLimit($select)
        {
            switch ($select) {
                case '0':
                    return 0;
                    break;
                case '1':
                    return 10;
                    break;
                case '2':
                    return 25;
                    break;
                case '3':
                    return 50;
                    break;
            }
        }
        public static function getInputSelectText($select)
        {
            switch ($select) {
                case '0':
                    return 0;
                    break;
                case '1':
                    return "Просьба";
                    break;
                case '2':
                    return "Предложение";
                    break;
                case '3':
                    return "Отзыв";
                    break;
            }
        }
    }
?>