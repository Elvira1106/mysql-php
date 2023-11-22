<?php
session_start();
$title = "Редактирование сообщения";
require "blocks/header.php";
unset($_SESSION['error_username']);
unset($_SESSION['error_email']);
unset($_SESSION['error_parol']);
unset($_SESSION['error_bio']);
unset($_SESSION['text']);
?>
<h1 class = "mt-5"> <?=$title?> </h1>
<form >
        <input type="text" name="subject"  value="<?= output_key_if_it_exists('sub') ?>" placeholder="Введите тему сообщения" class="form-control"><br>
        <div class="text-danger"><?=output_key_if_it_exists('error_sub')?></div><br>
        <textarea name="message"  placeholder="Введите сообщение" class="form-control"><?= output_key_if_it_exists('des') ?></textarea><br>
        <div class="text-danger"><?=output_key_if_it_exists('error_mes')?></div><br>
        <select class="combo"  name="course" size="1"><br>
      
<option value="Select">Выберете себя</option>
<?php
$arr = []; 
$mysql = new mysqli("localhost", "root", "", "bd_test");
$count = $mysql->query("SELECT * FROM user");
while($row = $count->fetch_assoc()) //записали в массив все id строк.
{
   array_push($arr, $row['name']);
}
for($i = 0; $i<=count($arr)-1; $i++) //выводим список
{
    echo "<option name=\"user\" value=\"$arr[$i]\">$arr[$i]</option>";
}

$mysql->close();
?>
</select>
<div class="text-danger"><?=output_key_if_it_exists('error_user')?></div><br>
<div class="mt-5"></div>
        <input formaction="check_contact.php" formmethod="post" type="submit" value="Отправить" class="btn btn-success"/>
        <input formaction="update_con.php" type="submit" value="Обновить страницу" class="btn btn-success"/>
    </form>
   <div class=<?= output_key_if_it_exists('clas') ?>><?=output_key_if_it_exists('success_mes')?></div> 

 
<?php
 
function output_key_if_it_exists($key){
        if (array_key_exists($key,$_SESSION))
        return $_SESSION[$key];
    }

require "blocks/footer.php";
?>