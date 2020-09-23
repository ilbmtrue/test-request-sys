<?php include ROOT . '/layouts/head.php'; ?>
<?  
    if($_SERVER['QUERY_STRING']){
        $params = array();parse_str($_SERVER['QUERY_STRING'], $params);
    } else {
        $params["type"] = "0";
        $params["fio"] = "";
        $params["limit"] = "10";
        $params["time"] = "0";
    }
?>
<body>
    <div class="container">
        <h3>Заявки</h3>
        <div class="requests-container">
            <form action="/requests/filter">
                <div class="row">
                    <div class="col m2">
                        <label>фильтр по типу</label>
                        <select class="browser-default" name="type">
                            <option value="0" <? echo ($params["type"] == 0) ? "selected" : "";?>>Все</option>
                            <option value="1" <? echo ($params["type"] == 1) ? "selected" : "";?>>Просьба</option>
                            <option value="2" <? echo ($params["type"] == 2) ? "selected" : "";?>>Предложение</option>
                            <option value="3" <? echo ($params["type"] == 3) ? "selected" : "";?>>Отзыв</option>
                        </select>
                    </div>
                    <div class="col m2">
                        <label>Фильтровать по имени</label>
                        <div class="input-field inline" style="margin: 0;">
                            <input id="fio_search" type="text" name="fio" class="validate" <? echo ($params["fio"] !== "") ? "value=". $params["fio"] ."" : "";?>>
                        </div>
                    </div>
                    <div class="col m3">
                        <label>Время</label>
                        <select class="browser-default" name="time">
                            <option value="1" <? echo ($params["time"] == 1) ? "selected" : "";?>>По возрастанию</option>
                            <option value="2" <? echo ($params["time"] == 2) ? "selected" : "";?>>По убыванию</option>
                        </select>
                    </div>
                    <div class="col m2">
                        <label>выводить по</label>
                        <select class="browser-default" name="limit">
                            <option value="0" <? echo ($params["limit"] == 0) ? "selected" : "";?>>Все</option>
                            <option value="1" <? echo ($params["limit"] == 1) ? "selected" : "";?>>10</option>
                            <option value="2" <? echo ($params["limit"] == 2) ? "selected" : "";?>>25</option>
                            <option value="3" <? echo ($params["limit"] == 3) ? "selected" : "";?>>50</option>
                        </select>
                    </div>
                    <div class="col m2" style="line-height: 80px;">
                        <button class="btn btn-large waves-effect waves-light" type="submit">показать</button>
                    </div>
                </div>
            </form>
            <style>
                tr:hover {
                    background-color: #f0f8ff;
                    cursor: pointer;
                }
            </style>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Тип</th>
                        <th>ФИО</th>
                        <th>Адресс</th>
                        <th>Телеофн</th>
                        <th>email</th>
                        <th>Дата и время</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach($requests as $request): ?>
                        <tr>
                            <td><? echo $request["id"]; ?></td>
                            <td><? echo $request["type"]; ?></td>
                            <td><? echo $request["fio"]; ?></td>
                            <td><? echo $request["address"]; ?></td>
                            <td><? echo $request["phone"]; ?></td>
                            <td><? echo $request["email"]; ?></td>
                            <td><? echo $request["timestamp_update"]; ?></td> 
                            <td><a class='small material-icons' href='/request/edit/<? echo trim($request['id']); ?>'>create</a></td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>