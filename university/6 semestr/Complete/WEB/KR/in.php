<?php

	setcookie('user', $user['login'], time() - 3600, "/");
	
 	echo '
 	
<!DOCTYPE html>

<HTML lang="ru"> 

<HEAD>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>А-07-19 Женюх Александр</title>
	<link rel="stylesheet" href="/KR_WEB/style1.css">
</HEAD>

<BODY>
	
    <h1>Добро пожаловать в онлайн-энциклопедию "В мире животных"</h1>
	
		<table class="table_style" border="1" cellpadding="15">
			<tr>

				<td>
				
				    <h2>Если у Вас уже есть учетная запись, введите свои логин и пароль в форму ниже<h2>
				    
					<form action="vhod.php" method="post">
						
						<input class="input_style"  type="text" class="form-control" name="login" 
						id="login" placeholder="Поле для логина"><br>
						
						<input class="input_style"  type="password" class="form-control" name="pass" 
						id="pass" placeholder="Поле для пароля"><br>
						
						<button class="button" type="submit">Войти на сайт</button>
					
					</form>
				</td>
				
			</tr>
			
		</table><br>
		
		<div><b>У вас еще нет учетной записи?<br><br>
		<a style="color: #444" href="/KR_WEB/registration.php">Зарегистрироваться</a></b></div><br>
		
		<br>
		
		<img class="style_img" src="/KR_WEB/img/anima.png"/>
</BODY>

</HTML>
 	
 	';
?>
