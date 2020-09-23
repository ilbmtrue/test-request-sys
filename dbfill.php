<?
/* 
    для заполнения бд пользовался https://randomuser.me
    например url: [домен сайта]/dbfill.php?persons=50
*/
 include('layouts/head.php')?>
<script>
    var objXMLHttpRequest = new XMLHttpRequest();
    var objXMLHttpRequestToServer = new XMLHttpRequest();
    var persons = [];
    objXMLHttpRequestToServer.onreadystatechange = function() {
        if((objXMLHttpRequestToServer.readyState === 4) && (objXMLHttpRequestToServer.status === 200) ){
            // console.log(persons);
        } else {
            console.log(objXMLHttpRequestToServer.status);
            console.log(objXMLHttpRequestToServer.statusText);
        }
    }
    objXMLHttpRequest.onreadystatechange = function() {
        if(objXMLHttpRequest.readyState === 4) {
            if(objXMLHttpRequest.status === 200) {
                let ans = objXMLHttpRequest.responseText;
                let arr = JSON.parse(ans);
                let php_arr = null;
                arr.results.forEach( (item, i, arr) => {
                    let n = item.name.first + ' ' + item.name.last;
                    let p = item.phone;
                    let em = item.email;
                    let ad = item.location.city + ' ' + item.location.street.name + ', ' + item.location.street.number
                    let sss = "";
                    for(var index in item.login) { 
                        sss += item.login[index] + ' ';
                    }
                    let text = sss.trim();
                    persons.push([n, ad, p, em, text]);                   
                });
                objXMLHttpRequestToServer.open('POST', 'dbfill.php');
                objXMLHttpRequestToServer.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                objXMLHttpRequestToServer.send('data=' + JSON.stringify(persons));
            } else {
                console.log('Error Code: ' +  objXMLHttpRequest.status);
                console.log('Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
    }
    objXMLHttpRequest.open('GET', 'https://randomuser.me/api/?results=<? echo !empty($_GET["persons"]) ? $_GET["persons"] : "1" ?>');
    objXMLHttpRequest.send();
</script>
<body>
<?php
    include_once('./components/Autoload.php');
    if($data = json_decode($_REQUEST['data'])){
        $query_str = "";
        $typeArr = array();
        $typeArr[] = "Просьба";
        $typeArr[] = "Предложение";
        $typeArr[] = "Отзыв";
        $dsn = "mysql:host=127.0.0.1:3306;dbname=requests";
        $db = new PDO($dsn, 'manager', 'Test1234');
        $db->exec("set names utf8");
        for ($i=0; $i < count($data); $i++) { 
            $query_str .= "('" . $typeArr[rand(0,2)] . "', '" . 
                                $data[$i][0] . "', '" . 
                                $data[$i][1] . "', '" . 
                                $data[$i][2] . "', '" . 
                                $data[$i][3] . "', '" . 
                                $data[$i][4]. "'), ";
            $query_str = substr_replace($query_str,'; ',-2);
            $query = 'INSERT INTO requests.request (`type`, `fio`, `address`, `phone`, `email`, `msg`) VALUES ' . $query_str; 
            $result = $db->prepare($query);
            $result->execute();
            $query_str = "";
        }
        var_dump($result);
    } else {
        var_dump("refresh");
    }
?>
</body>