<?php
$conn = new mysqli("localhost", "root", "40MinDmysqlstudy", "LR2");

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Подключение не удалось: %s\n", mysqli_connect_error());
    exit();
}

$login = $conn->real_escape_string($_POST["login"]);
$password = $conn->real_escape_string($_POST["password"]);
    $sql = "SELECT * FROM users WHERE username = '$login'";
    if($result = $conn->query($sql)){
        if($result->num_rows > 0){          
            echo "<p>Пользователь уже существует</p>";
        }
        else{
			$sql = "INSERT INTO users (username, password) VALUES ('$login', '$password')";
			if($conn->query($sql)){
				echo "Данные успешно добавлены";
			} else{
				echo "Ошибка: " . $conn->error;
			}	
        }
        $result->free();
	}
/* закрытие соединения */
$conn->close();
?>