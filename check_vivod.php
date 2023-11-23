<?php
session_start();
ob_start();

//удаляем все ненужное перед отправить
unset($_SESSION['empty']);
unset($_SESSION['error_us']);
unset($_SESSION['succ_mes']);

$subj = $_POST['course_sub'];
$_SESSION['course_sub'] = $subj;
function redirect() { //переадресация
    header('Location: http://localhost:3000/mysql%20+%20php/redact.php');
    exit;
}

if ($_SESSION['course_sub']== "Выберете свою тему сообщения") {
    $_SESSION['empty'] = "Не выбрана тема";
    redirect();
} else {
    
    $mysql = new mysqli("localhost", "root", "", "bd_test");
    $res1 = $mysql->query("SELECT `subject` from message where message.subject = '$subj'");
    $res2 = $mysql->query("SELECT `descroption` from message where message.subject = '$subj'");
    $res3 = $mysql->query("SELECT `user_id_user` from message where message.subject = '$subj'");
    $subject = $res1->fetch_array()['0'] ?? ''; //достаем нужный id пользователя из массива
    $user = $res3->fetch_array()['0'] ?? '';
    $mes = $res2->fetch_array()['0'] ?? '';
    if ($subject && $user && $mes) {
        $_SESSION['subj'] =  $subject;
        $_SESSION['message'] =  $mes;
        $_SESSION['course_sub'] = $subj;
        $res4 = $mysql->query("SELECT `name` from user, message
        where user.id_user = message.user_id_user and
        user_id_user = $user
        group by user.name");
        $user_name = $res4->fetch_array()['0'] ?? '';
        $_SESSION['user_name'] =  $user_name;
    } else {
        $_SESSION['class'] = "text-danger";
        $_SESSION['succ_mes'] = "Ошибка: " . $mysql->error;
    }
    redirect();
    $mysql->close();
    ob_end_flush();
    exit;
}

   

