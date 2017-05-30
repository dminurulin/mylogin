<h1>ИЗМЕНЕНИЕ ДАННЫХ О ПОЛЬЗОВАТЕЛЕ</h1>

<form action="/auth/change" method="post">
  <input type="hidden" name="userid" value="<?php echo "$userid"; ?>">  
  <label>Логин: </label><input type="text" name="login" value="<?php echo "$username"; ?>"><br>
  <label>Старый пароль: </label><input type="password" name="password"><br>
  <label>Новый пароль: </label><input type="password" name="newpass"><br>
  <label>Новый пароль (повторить): </label><input type="password" name="newpassrep"><br>
  <label>ФИО (фамилия имя и отчество): </label><input type="text" name="fio" style="width:400" value="<?php echo "$fio"; ?>"><br>
  <label></label><input type="submit">
</form>
<br><br>