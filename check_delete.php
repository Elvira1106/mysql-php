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
unset($_SESSION['success_mes']);
unset($_SESSION['subj']);
unset($_SESSION['message']);
unset($_SESSION['class']);
unset($_SESSION['succ_mes']);
unset($_SESSION['user_name']);

$subj = $_POST['course_sub'];
function redirect() { //переадресация
    header('Location: http://localhost:3000/mysql%20+%20php/redact.php');
    exit;
}

if ($subj == 'Select' ) {
    $_SESSION['subj_error'] = "Не выбрана тема";
    redirect();
} else if (!$_SESSION['subj'] || !$_SESSION['message'] || !$_SESSION['user_name'])
{
    $_SESSION['empty'] = 'Заданы пустые поля';
    redirect();
}
    else
    {
        $mysql = new mysqli("localhost", "root", "", "bd_test");
        $res1 = $mysql->query("SELECT `subject` from message where message.subject = '$subj'");
        $res2 = $mysql->query("SELECT `descroption` from message where message.subject = '$subj'");
        $res3 = $mysql->query("SELECT `user_id_user` from message where message.subject = '$subj'");
        $subject = $res1->fetch_array()['0'] ?? ''; //достаем нужный id пользователя из массива
        $user = $res3->fetch_array()['0'] ?? '';
        $mes = $res2->fetch_array()['0'] ?? '';
        if ($mysql->query("INSERT INTO `message` (`subject`, `descroption`, `user_id_user`) VALUES ('$subject', '$mes', $user)")) {
            $_SESSION['subj'] =  $subject;
            $_SESSION['message'] =  $mes;
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
  



   

