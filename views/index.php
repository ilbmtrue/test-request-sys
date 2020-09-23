<?php include ROOT . '/layouts/head.php'; ?>

<body>
  <div class="header">
    <div>
        <?php if (User::isGuest()): ?>                                        
          <a href="login"><button class="btn waves-effect waves-light">Вход для сотрудника</button></a>
        <?php else: ?>
          <a href="logout"><button class="btn waves-effect waves-light">Выйти</button></a>
        <?php endif; ?>
    </div>
  </div>
  <div class="container">
    <div class="col s12 m10 offset-m1">
      <h2 class="header">Форма заявки</h1>
    </div>
    <div class="row">
      <form class="col s12" method="POST" action="addRequest">
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Иванов Иван Иванович" id="fio" name="fio" type="text" class="validate" required>
            <label for="fio">ФИО</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Уличная ул. д.1" id="address" name="address" type="text" class="validate">
            <label for="address">Адрес</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input placeholder="89998887766" id="phone" name="phone" pattern=".*[^A-Za-zА-Яа-яЁё]" type="text" class="validate input-phone" required>
            <label for="phone">Телефон</label>
          </div>
          <div class="input-field col s6">
            <input placeholder="mail@domain.ru" id="email" name="email" type="text" class="validate">
            <label for="email">email</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12"> 
            <label>Тип заявки</label>
            <select class="browser-default" name="request_type" required>
                <option value="" disabled selected>Укажите причину обращения</option>
                <option value="1">Просьба</option>
                <option value="2">Предложение</option>
                <option value="3">Отзыв</option>
            </select>
          </div>
          <div class="input-field col s12">
            <textarea id="msg" name="msg" class="materialize-textarea" required></textarea>
            <label for="msg">Текст сообщения</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit">отправить</button>
      </form>
    </div>
  </div>
</body>
</html>