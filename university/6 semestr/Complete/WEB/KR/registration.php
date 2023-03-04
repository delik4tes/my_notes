<?php

	setcookie('user', $user['login'], time() - 3600*24, "/");
	
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
				
				    <h2>Если у Вас нет учетной записи, зарегистрируйтесь в форме ниже<h2>
				    
					<form action="reg.php" method="post">
						
						<input class="input_style"  type="text" class="form-control" name="login" 
						id="login" placeholder="Придумайте логин"><br>
						
						<input class="input_style" type="password" class="form-control" name="pass" 
						id="pass" placeholder="Придумайте пароль"><br>
						
						<input type="radio" name="rights" value="redactor"><div>Редактор</div>
						<input type="radio" name="rights" value="reader"><div>Пользователь</div><br><br>
						
						<button class="button" type="submit">Зарегистрироваться</button>
					
					</form>
			
				</td>
				
			</tr>
			
		</table><br>
		
		<div><b>У вас уже есть учетная запись?<br><br>
		<a style="color: #444" href="/KR_WEB/in.php">Войти</a></b></div><br>
		
		<br>
		
		<img class="style_img" src="/KR_WEB/img/ann.png"/>
</BODY>

</HTML>
 	
 	';
?>
