<?php
$conn = new mysqli("localhost", "root", "40MinDmysqlstudy", "LR2");

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Подключение не удалось: %s\n", mysqli_connect_error());
    exit();
}

$login = $conn->real_escape_string($_GET["login"]);
$password = $conn->real_escape_string($_GET["password"]);
    $sql = "SELECT * FROM users WHERE username = '$login' and password = '$password'";
    if($result = $conn->query($sql)){
        if($result->num_rows > 0){          
            header("Location: record.html"); exit;
        }
        else{
            echo "<p>Пользователь не найден</p>";
        }
        $result->free();
	}
/* закрытие соединения */
$conn->close();
?>