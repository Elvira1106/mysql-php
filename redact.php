<?php
session_start();
$title = "Редактирование сообщения";
require "blocks/header.php";
unset($_SESSION['clas']);
unset($_SESSION['text']);
unset($_SESSION['error_username']);
unset($_SESSION['error_email']);
unset($_SESSION['error_parol']);
unset($_SESSION['error_bio']);
unset($_SESSION['error_sub']);
unset($_SESSION['error_mes']);
unset($_SESSION['error_user']);
unset($_SESSION['success_mes']);
?>
<h1 class = "mt-5"> <?=$title?> </h1>
<form >
<input type="text" name="subj"  value="<?= output_key_if_it_exists('subj') ?>" class="form-control"><br>
<input type="text" name="message"  value="<?= output_key_if_it_exists('message') ?>" class="form-control"><br>
<input type="text" name="user_name"  value="<?= output_key_if_it_exists('user_name') ?>" class="form-control"><br>
<div class="text-danger"><?=output_key_if_it_exists('error_us')?></div><br>
        <select class="combo"  name="course_sub" size="1"><br>

<option value="<?= output_key_if_it_exists2('course_sub')?>"> <?= output_key_if_it_exists2('course_sub')?> </option>
<?php
$arr = []; 
$mysql = new mysqli("localhost", "root", "", "bd_test");
$count = $mysql->query("SELECT * FROM message");
while($row = $count->fetch_assoc()) //записали в массив все id строк.
{
   array_push($arr, $row['subject']);
}
for($i = 0; $i<=count($arr)-1; $i++) //выводим список
{
    echo "<option name=\"user\" value=\"$arr[$i]\">$arr[$i]</option>";
}
$mysql->close();
?>
</select>
<div class="text-danger"><?=output_key_if_it_exists('empty')?></div><br>
<div class="mt-5"></div>
<input formaction="check_vivod.php" formmethod="post" type="submit" value="Вывести" class="btn btn-success"/>
        <input formaction="check_redact.php" formmethod="post" type="submit" value="Редактировать" class="btn btn-success"/>
        <input formaction="check_delete.php" formmethod="post" type="submit" value="Удалить" class="btn btn-success"/>
        <input formaction="update_red.php" type="submit" value="Обновить страницу" class="btn btn-success"/>
    </form>
   <div class=<?= output_key_if_it_exists('class') ?>><?=output_key_if_it_exists('succ_mes')?></div> 

 
<?php
 
function output_key_if_it_exists($key){
        if (array_key_exists($key,$_SESSION))
        return $_SESSION[$key];
    }
    function output_key_if_it_exists2($key){
        if (array_key_exists($key,$_SESSION))
        return $_SESSION[$key];
    else 
    return "Выберете свою тему сообщения";
    }
require "blocks/footer.php";
?>


