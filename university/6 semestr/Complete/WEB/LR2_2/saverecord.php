<?php
$type1 = $_GET["type1"];
$type2 = $_GET["type2"];
$type3 = $_GET["type3"];
$qua1 = $_GET["qua1"];
$qua2 = $_GET["qua2"];
$qua3 = $_GET["qua3"];
$papertype = $_GET["papertype"];

$guache = "нет";
$watercolor = "нет";
$marker = "нет";
$eraser = "нет";
if(isset($_GET["guache"])){
	$guache = "да";
}
if(isset($_GET["watercolor"])){
	$watercolor = "да";
}
if(isset($_GET["marker"])){
	$marker = "да";
}
if(isset($_GET["eraser"])){
	$eraser = "да";
}
$comment = $_GET["comment"];
$phone = $_GET["phone"];
$sms = "нет";
}
if(isset($_GET["sms"])){
	$sms = "да";
}
$delivery = $_GET["delivery"];
$address = $_GET["address"];

$conn = new mysqli("localhost", "root", "40MinDmysqlstudy", "LR2");

/* проверка соединения */
if (mysqli_connect_errno()) {
    printf("Подключение не удалось: %s\n", mysqli_connect_error());
    exit();
}

$sql = "INSERT INTO records (type1, type2, type3, qua1, qua2, qua3, papertype, guache, watercolor, marker, eraser, comment, phone, sms, delivery, address)
VALUES ('$type1', '$type2', '$type3', '$qua1', '$qua2', '$qua3', '$papertype', '$guache', '$watercolor', '$marker', '$eraser', '$comment', '$phone', '$sms', '$delivery', '$address')";
if($conn->query($sql)){
	echo "Данные успешно добавлены";
} else{
	echo "Ошибка: " . $conn->error;
}
			
/* закрытие соединения */
$conn->close();
?>