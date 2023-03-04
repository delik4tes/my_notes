<?php

	class add_animal_vid extends AdminMainClass {
	
		protected function edit(){
			
			$title = $_POST['title'];
			
			if(empty($title)){
				exit("Не заполнены обязательные поля");
			}
			
			$query = "INSERT INTO animal_vid (name_animal_vid) VALUES ('$title')";
			$link = mysqli_connect(HOST, USER, PASSWORD, DB);
			$result = mysqli_query($link, $query);
			if(!$result){
				exit(mysqli_error($link));
			}
			else {
				$_SESSION['res'] = "Изменения сохранены";
				header("Location:?option=edit_animal_vid");
				exit;
			}
		
		}
		
		public function get_content(){
			echo "<div>";
		
			if($_SESSION['res']){
				echo $_SESSION['res'];
				unset($_SESSION['res']);
			}
			
			print <<<HEREDOC
			<form action="" method="POST">
				<p>Название новой категории животных:<br>
				<input type='text' name='title' style='width:420px;'>
				</p>
				
				<p><input type='submit' name='button' value='Добавить'></p></form></div>
			HEREDOC;
			
		}
	}
?>
