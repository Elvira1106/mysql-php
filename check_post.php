<?php
session_start();
ob_start();

//удаляем все ненужное перед отправить
unset($_SESSION['clas']);
unset($_SESSION['text']);
unset($_SESSION['error_username']);
unset($_SESSION['error_email']);
unset($_SESSION['error_parol']);
unset($_SESSION['error_bio']);
unset($_SESSION['error_sub']);
unset($_SESSION['error_mes']);
unset($_SESSION['error_user']);

$mysql = new mysqli("localhost", "root", "", "bd_test");
$_SESSION['username'] = $mysql->real_escape_string($_POST['username']);
$_SESSION['email'] = $mysql->real_escape_string($_POST['email']);
$_SESSION['pass'] = $mysql->real_escape_string($_POST['pass']);
$_SESSION['bio'] = $mysql->real_escape_string($_POST['bio']);

$name = $_SESSION['username'];
$email = $_SESSION['email'];
$parol = $_SESSION['pass'];
$bio = $_SESSION['bio'];

function redirect() { //переадресация
    header('Location: http://localhost:3000/mysql%20+%20php/about.php');
    exit;
}

if (strlen($name) <= 1) {
    $_SESSION['error_username'] = "Введите корректное имя";
    redirect();
} else if (strlen($email) < 5 || strpos($email, "@") == false) {
    $_SESSION['error_email'] = "Вы ввели некорреткный email";
    redirect();
} else {
   
}
if (!test_pass_up($parol) || !test_pass_dig($parol) || strlen($parol) < 6) {
    $_SESSION['error_parol'] = "Пароль введен некорректно";
    redirect();
} else if (strlen($bio) <= 15) {
    $_SESSION['error_bio'] = "Сообщение не менее 15 символов";
    redirect();
} else {
    require "blocks/connect.php";
    if ($mysql->query("INSERT INTO `user` (`name`, `email`, `password`, `bio`) VALUES ('$name', '$email', '$parol', '$bio')")) {
        $_SESSION['clas'] = "text-success";
        $_SESSION['text'] = "Данные успешно добавлены";
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['pass']);
        unset($_SESSION['bio']);
    } else {
        $_SESSION['clas'] = "text-danger";
        $_SESSION['text'] = "Ошибка: " . $mysql->error;
    }
    header('Location: http://localhost:3000/mysql%20+%20php/about.php');
    $mysql->close();
    ob_end_flush();
    exit;
}
function test_pass_up($parol)
{
    for ($i = 0; $i <= strlen($parol); $i++) {
        if (ctype_upper($parol[$i])) 
        {
            return 1;
        }
        
    }
    return 0;
}

function test_pass_dig($parol)
{
    for ($i = 0; $i <= strlen($parol); $i++) {
        if (ctype_digit($parol[$i])) 
        {
            return 1;
        }
        
    }
    return 0;
}