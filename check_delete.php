<?php
session_start();
ob_start();

//удаляем все ненужное перед отправить


unset($_SESSION['succ_mes']);
unset($_SESSION['empty']);
unset($_SESSION['error_us']);


$subj = $_POST['course_sub'];
$_SESSION['course_sub'] = $subj;
$_SESSION['subj'] = $_POST['subj'];
$_SESSION['message'] = $_POST['message'];
$_SESSION['user_name'] = $_POST['user_name'];

$descr = $_SESSION['message'];
$subj = $_POST['course_sub'];
$user = $_SESSION['user_name']; 
function redirect() { //переадресация
    header('Location: http://localhost:3000/mysql%20+%20php/redact.php');
    exit;
}
if ($_SESSION['course_sub'] == "Выберете свою тему сообщения") {
    $_SESSION['empty'] = "Не выбрана тема";
    redirect();
} else if (!$descr || !$descr || !$user){
    $_SESSION['empty'] = 'Заданы пустые поля';
    redirect();
}
    else
    {
        $mysql = new mysqli("localhost", "root", "", "bd_test");
        if ($mysql->query("DELETE  from `message` where message.subject = '$subj'")) {
            unset($_SESSION['subj']);
            unset($_SESSION['message']);
            unset($_SESSION['user_name']);
            unset($_SESSION['empty']);
            $_SESSION['class'] = "text-success";
            $_SESSION['course_sub'] = "Выберете свою тему сообщения";
            $_SESSION['succ_mes'] = "Сообщение успешно удалено";
        } else {
            $_SESSION['class'] = "text-danger";
            $_SESSION['succ_mes'] = "Ошибка: " . $mysql->error;
        }
        redirect();
        $mysql->close();
        ob_end_flush();
        exit;
    }
  



   

