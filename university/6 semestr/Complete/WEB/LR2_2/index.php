<?php
$mysqli = new mysqli("localhost", "root", "40MinDmysqlstudy", "LR2");

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Подключение не удалось: %s\n", mysqli_connect_error());
    exit();
}

/* вывод информации о хосте */
printf("Информация о хосте: %s\n", $mysqli->host_info);

/* закрытие соединения */
$mysqli->close();
?>