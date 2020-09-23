<?php include ROOT . '/layouts/head.php'; ?>
    <div class="container">
      <div class="col s12 m10 offset-m1">
        <h1 class="header">Авторизация</h1>
      </div>
      <div class="row">
        <form class="col s12" method="POST" action="">
          <div class="row">
            <div class="input-field col s12">
              <input id="login" type="text" name="login" class="validate" required value="manager">
              <label for="login">Логин</label>
            </div>        
          </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="password" type="password" name="password" class="validate" required value="Test1234">
            <label for="password">Пароль</label>
          </div>
        </div>
        <div class="col s3">
          <button class="btn waves-effect waves-light" type="submit" name="submit">вход</button>
        </div>
          <div class="col s9" style="color:red;"><? if(isset($error)) echo($error); ?></div>
        </form>
      </div>
    </div>
  </body>
</html>