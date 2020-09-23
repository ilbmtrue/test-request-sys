<?php include ROOT . '/layouts/head.php'; ?>
<body>
  <div class="container">
      <div class="col s9 m10 offset-m1">
        <h2 class="header">Заявка # <? echo $request["id"] ?></h1>
      </div>
    <div class="row">
      <form class="col s12" method="POST" action="/request/edit/<? echo $request["id"] ?>">
        <input type="hidden" name="id" value="<?php echo $request['id']; ?>">
        <div class="row">
          <div class="input-field col s12">
            <input id="fio" name="fio" type="text" class="validate" required value="<? echo $request["fio"] ?>">
            <label for="fio">ФИО</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="address" name="address" type="text" class="validate" value="<? echo $request["address"] ?>">
            <label for="address">Адрес</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input id="phone" name="phone" type="text" pattern=".*[^A-Za-zА-Яа-яЁё]" class="validate input-phone" required value="<? echo $request["phone"] ?>">
            <label for="phone">Телефон</label>
          </div>
          <div class="input-field col s6">
            <input id="email" name="email" type="text" class="validate" value="<? echo $request["email"] ?>">
            <label for="email">email</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12"> 
            <label>Тип заявки</label>
            <select class="browser-default" name="request_type" required>
                <option value="" disabled>Укажите причину обращения</option>
                <option value="1" <? echo ($request["type"] == "Просьба") ? 'selected': "" ?>> Просьба</option>
                <option value="2" <? echo ($request["type"] == "Предложение") ? 'selected': "" ?>>Предложение</option>
                <option value="3" <? echo ($request["type"] == "Отзыв") ? 'selected': "" ?>>Отзыв</option>
            </select>
          </div>
          <div class="input-field col s12">
            <textarea id="msg" name="msg" class="materialize-textarea" required><? echo $request["msg"] ?></textarea>
            <label for="msg">Текст сообщения</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="edit">сохранить</button>
        <a href="/requests/"><input type="button" class="btn custom-btn" value="назад"></input></a>
      </form>  
    </div>
  </div>
</body>
</html>