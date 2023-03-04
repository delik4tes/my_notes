<?php
	class update_animal_vid extends AdminMainClass {
	
		protected function edit(){
			
			$id = $_POST['id'];
			$title = $_POST['title'];
			
			if( empty($title) ){
				exit("Не заполнены обязательные поля");
			}
						
			$query = "UPDATE animal_vid
				  SET name_animal_vid='$title'
				  WHERE id_animal_vid='$id'";
				  
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
		
			if ($_GET['id_text']){
				$id_text = (int)$_GET['id_text'];
			}
			else{
				exit("Некорректные данные для страницы");
			}
			
			$text = $this->get_name_animal_vid($id_text);
			
			echo "<div id='cont'>";
			
			if($_SESSION['res']){
				echo $_SESSION['res'];
				unset($_SESSION['res']);
			}
			
			print <<<HEREDOC
			<form action="" method="POST">
				<p>Новое название категории:<br>
				<input type='text' name='title' style='width:420px;' value='$text[name_animal_vid]'>
				<input type='hidden' name='id' style='width:420px;' value='$text[id_animal_vid]'></p>
				<p><input type='submit' name='button' value='Сохранить'></p></form></div>
			HEREDOC;	
		}
	}
?>
