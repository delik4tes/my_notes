<?php
	require_once("configuration.php");
	
	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
	$rights = $_POST['rights'];
	
	$mysql = new mysqli('localhost', 'root', 'mynewpassword', 'KR_WEB');
	
	$result = $mysql->query("SELECT * FROM `users` WHERE `login`='$login'");
	
	$user = $result->fetch_assoc();
	
	$hash = $user['pass'];
	
	if (count($user) == 0){
		echo "Такой пользователь не найден";
		exit();
	}
	
	setcookie('user', $user['login'], time() + 3600*24, "/");
	
	$mysql->close();
		
	if (password_verify($pass, $hash)){
	
	
	if ($user['rights'] == 'redactor'){
		header ('Location:/KR_WEB/index.php?option=redactor');
	}
	else if($user['rights'] == 'reader'){
		header ('Location:/KR_WEB/index.php');
	}
	else{
		exit("Нет такой страницы сайта");
	}
	
	}
	else{
			echo "Неверные данные для входа";
		exit();
	}

?>
