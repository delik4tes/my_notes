<?php
$conn = new mysqli("localhost", "root", "qwerty123", "lr2");

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Подключение не удалось: %s\n", mysqli_connect_error());
    exit();
}

$login = $conn->real_escape_string($_POST["login"]);
$password = $conn->real_escape_string($_POST["password"]);
    $sql = "SELECT * FROM users WHERE login = '$login'";
    if($result = $conn->query($sql)){
        if($result->num_rows > 0){          
            echo "<p>Такой пользователь уже существует</p>";
        }
        else{
			$sql = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
			if($conn->query($sql)){
				echo "Пользователь создан";
			} else{
				echo "Ошибка: " . $conn->error;
			}	
        }
        $result->free();
	}
/* закрытие соединения */
$conn->close();
?>