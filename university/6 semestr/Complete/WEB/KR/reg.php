<?php
	require_once("configuration.php");
	
	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
	$rights = $_POST['rights'];
	
	if(mb_strlen($login) < 3 || mb_strlen($login) > 10){
		echo "Логин должен содержать от 3 до 10 символов.";
		exit();
	}
	else if(mb_strlen($pass) < 3 || mb_strlen($pass) > 10){
		echo "ПАроль должен содержать от 3 до 10 символов.";
		exit();
	}
	else if(empty($_POST['rights'])){
		echo "Выберите права для регистрации";
		exit();
	}
	
	//хеширование пароля
	$pass = password_hash($pass, PASSWORD_DEFAULT);

	
	$query = "SELECT * FROM users 
	 	  WHERE login = '$login'";
	$link = mysqli_connect(HOST, USER, PASSWORD, DB);
	$result = mysqli_query($link, $query);
	if(!$result){
		exit(mysqli_error($link));
	}
	$col = mysqli_num_rows($result);

	if($col == 0){
		$sql = "INSERT INTO `users`(`login`, `pass`, `rights`) 
	VALUES ('$login', '$pass', '$rights') ";
		$result = mysqli_query($link, $sql);
		if(!$result){
			exit(mysqli_error($link));
		}
	}
	else{
		exit("Такой пользователь уже есть");
	}
	
	header ('Location:/KR_WEB/registration.php');
?>
