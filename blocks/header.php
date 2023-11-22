<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
    <link rel = "stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
 <?php require "connect.php"; ?>  <!--подключение бд -->
<div class= "container mt-5">
    <header>
        <a href="index.php"> Главная </a> 
        | <a href = "about.php"> Пользователь </a>
        | <a href = "contact.php"> Сообщение </a>
        | <a href = "redact.php"> Редактирование </a>
</header>  
