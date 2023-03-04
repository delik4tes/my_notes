<?php
	class edit_animal_vid extends AdminMainClass {
		public function get_content(){
			
			$query = "SELECT id_animal_vid, name_animal_vid FROM animal_vid";
			$link = mysqli_connect(HOST, USER, PASSWORD, DB);
			$result = mysqli_query($link, $query);
			if(!$result){
				exit(mysqli_error($link));
			}
		
			echo '<div id="cont">';
			
			if($_SESSION['res']){
				echo $_SESSION['res'];
				unset($_SESSION['res']);
			}
			
			$row = array();
			for ($i = 0; $i < mysqli_num_rows($result); $i++){
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
				printf("<div>
					<b><a style='color:#444, text-decoration: none''>%s</a></b><br><br>
					&#9998;<a style='color:#444' href='?option=update_animal_vid&id_text=%s'>Редактировать</a><br>
					&#9746;<a style='color:#444' href='?option=delete_animal_vid&del_text=%s'>Удалить</a></div><br>",   $row['name_animal_vid'], $row['id_animal_vid'], $row['id_animal_vid']);
			}
			
			echo "</div>";
			
			echo "</div>";
		}
	}
?>
