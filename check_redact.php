<?php
session_start();
ob_start();

//удаляем все ненужное перед отправить

unset($_SESSION['succ_mes']);
unset($_SESSION['empty']);
unset($_SESSION['error_us']);

$descr = $_POST['message'];
$subj = $_POST['subj'];
$user = $_SESSION['user_name'];
$sebj_ses = $_SESSION['subj'];
$user_red = $_POST['user_name'];
function redirect()
{ //переадресация
    header('Location: http://localhost:3000/mysql%20+%20php/redact.php');
    exit;
}
if ($subj == "Выберете свою тему сообщения") {
    $_SESSION['empty'] = "Не выбрана тема";
    redirect();
} else if (!$descr || !$descr || !$user) {
    $_SESSION['empty'] = 'Заданы пустые поля';
    redirect();
} else if ($user != $user_red) {
    $_SESSION['error_us'] = 'Нельзя редактировать пользователя';
    redirect();
} else {
    $mysql = new mysqli("localhost", "root", "", "bd_test");
    $res = $mysql->query("SELECT `user_id_user` from message where message.subject = '$subj'");
    $user = $res->fetch_array()['0'] ?? ''; //достаем нужный id пользователя из массива
    if ($mysql->query("UPDATE `message` SET `subject` = '$subj', `descroption` = '$descr' where message.subject = '$sebj_ses'")) {
        $_SESSION['class'] = "text-success";
        $_SESSION['subj'] = $subj;
        $_SESSION['course_sub'] = $subj;
        $_SESSION['message'] = $descr;
        $_SESSION['succ_mes'] = "Сообщение успешно отредактировано";
    } else {
        $_SESSION['class'] = "text-danger";
        $_SESSION['succ_mes'] = "Ошибка: " . $mysql->error;
    }
    redirect();
    $mysql->close();
    ob_end_flush();
    exit;
}
