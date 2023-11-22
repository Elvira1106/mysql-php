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

$mysql = new mysqli("localhost", "root", "", "bd_test");
$_SESSION['sub'] = $mysql->real_escape_string($_POST['subject']);
$_SESSION['des'] = $mysql->real_escape_string($_POST['message']);
$sub = $_SESSION['sub'];
$des = $_SESSION['des'];
$user = $_POST['course'];
function redirect() { //переадресация
    header('Location: http://localhost:3000/mysql%20+%20php/contact.php');
    exit;
}

if (strlen($sub) <= 5) {
    $_SESSION['error_sub'] = "Сообщение должно содержать не менее 5 символов";
    redirect();
} else if (strlen($des) <= 15) {
    $_SESSION['error_mes'] = "Сообщение должно содержать не менее 15 символов";
    redirect();
} else if ($user == 'Select' ) {
    $_SESSION['error_user'] = "Не выбран пользователь";
    redirect();
} else {
    
    $mysql = new mysqli("localhost", "root", "", "bd_test");
    $res = $mysql->query("SELECT `id_user` from user where user.name = '$user'");
    $tourresult = $res->fetch_array()['0'] ?? ''; //достаем нужный id пользователя из массива
    if ($mysql->query("INSERT INTO `message` (`subject`, `descroption`, `user_id_user`) VALUES ('$sub', '$des', $tourresult)")) {
        $_SESSION['clas'] = "text-success";
        $_SESSION['success_mes'] = "Сообщение успешно отправлено";
        unset($_SESSION['sub']);
        unset($_SESSION['des']);
    } else {
        $_SESSION['clas'] = "text-danger";
        $_SESSION['success_mes'] = "Ошибка: " . $mysql->error;
    }
    redirect();
    $mysql->close();
    ob_end_flush();
    exit;
}

   

