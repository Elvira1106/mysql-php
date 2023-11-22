
<?php
   $mysql = new mysqli("localhost", "root", "", "bd_test");
   $mysql->query("SET NAMES 'utf8'"); //устанавливаем кодировку
   if (!$mysql) {
    die("Connection failed: " . mysqli_connect_error());
}
else 
{   echo "База данных подключена успешно";
//     $sql ="CREATE TABLE users2(
//         name VARCHAR(30) NOT NULL,
//         surname VARCHAR(30) NOT NULL PRIMARY KEY,
//         password VARCHAR(30) NOT NULL )";
        
//     //mysqli_query($mysql, $sql);
//    $mysql->query("DROP TABLE users2");
}

