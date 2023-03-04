<?php
	session_start();
	header("Content-Type:text/html;charset=UTF-8");
	
	require_once("MainClass.php");
	require_once("AdminMainClass.php");
	
	require_once("configuration.php");
	
	if($_COOKIE['user'] == ''){
		header("Location:/KR_WEB/registration.php");
	}
	
	if(isset($_GET['option'])){
		$class = trim(strip_tags($_GET['option']));
	}
	else {
		$class = 'reader';
	}
	
	if(file_exists($class.".php")){
		include($class.".php");
		if(class_exists($class)){
			$web = new $class;
			$web->get_body();
		}
		else{
			exit("<p>Неправильные данные для входа</p>");
		}
	}
	else{
		exit("<p>Неправильный адрес сайта</p>");
	}
?>
