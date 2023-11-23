<?php
$title = "Главная страница";
require "blocks/header.php";
$mysql->close();
//удаляем все ненужное перед отправить
session_start();

unset($_SESSION['text']);
unset($_SESSION['error_username']);
unset($_SESSION['error_email']);
unset($_SESSION['error_parol']);
unset($_SESSION['error_bio']);
unset($_SESSION['error_sub']);
unset($_SESSION['error_mes']);
unset($_SESSION['error_user']);
unset($_SESSION['success_mes']);
unset($_SESSION['course_sub']);
unset($_SESSION['empty']);
unset($_SESSION['succ_mes']);
?>
<h2 align="center" style="color:Black"> <?=$title?> </h2>
<img src = https://klike.net/uploads/posts/2022-08/1661254766_j-131.jpg />
<?php
require "blocks/footer.php";
?>