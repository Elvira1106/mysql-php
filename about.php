<?php
session_start();
$title = "Про нас";
require "blocks/header.php";

unset($_SESSION['error_sub']);
unset($_SESSION['error_mes']);
unset($_SESSION['error_user']);
unset($_SESSION['success_mes']);
unset($_SESSION['course_sub']);
unset($_SESSION['empty']);
unset($_SESSION['succ_mes']);
?>
<div class="container mt2"> <!--отступ 2 сверху и выравнивание посередине-->
    <h1> Пользователь </h1>
    <form >
        <input type="text" name="username" value="<?=output_key_if_it_exists('username')?>" placeholder="Введите имя" class="form-control"><br>
        <div class="text-danger"><?=output_key_if_it_exists('error_username')?></div><br>
        <input type="email" name="email" value="<?=output_key_if_it_exists('email')?>" placeholder="Введите почту" class="form-control"><br>
        <div class="text-danger"><?=output_key_if_it_exists('error_email')?></div><br>
        <input type="password" name="pass" value="<?=output_key_if_it_exists('pass')?>" placeholder="Введите пароль" class="form-control"><br>
        <div class="text-danger"><?=output_key_if_it_exists('error_parol')?></div><br>
        <textarea type="text" name="bio" placeholder="Введите o себе" class="form-control"><?=output_key_if_it_exists('bio')?></textarea><br>
        <div class="text-danger"><?=output_key_if_it_exists('error_bio')?></div><br>
        <input formaction="check_post.php" formmethod="post" type="submit" value="Добавить пользователя" class="btn btn-success"/>
        <input formaction="update_ab.php" formmethod="post" type="submit" value="Обновить страницу" class="btn btn-success"/>
    </form>
    <div class=<?= output_key_if_it_exists('clas') ?>><?=output_key_if_it_exists('text')?></div> 
</div>
<?php
function output_key_if_it_exists($key){
    if (array_key_exists($key,$_SESSION))
    return $_SESSION[$key];
};
require "blocks/footer.php";
?>