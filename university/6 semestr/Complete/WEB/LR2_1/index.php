<?php
$mysqli = new mysqli("localhost", "root", "qwerty123", "LR2");

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Подключение не удалось: %s\n", mysqli_connect_error());
    exit();
}

printf("Информация о хосте: %s\n", $mysqli->host_info);

$mysqli->close();
?>