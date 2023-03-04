<?php
	class redactor extends AdminMainClass {
		public function get_content(){
			
			$query = "SELECT id, title FROM posts";
			$link = mysqli_connect(HOST, USER, PASSWORD, DB);
			$result = mysqli_query($link, $query);
			if(!$result){
				exit(mysqli_error($link));
			}
		
			echo "<div id='cont'>";
			
			if($_SESSION['res']){
				echo $_SESSION['res'];
				unset($_SESSION['res']);
			}
			
			$row = array();
			for ($i = 0; $i < mysqli_num_rows($result); $i++){
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
				printf("<div>
					<b><a style='color:#444, text-decoration: none''>%s</a> </b>
					&#9998;<a style='color:#444' href='?option=edit_posts&id_text=%s'>Редактировать</button><br>
					&#9746;<a style='color:#444' href='?option=delete_posts&del_text=%s'>Удалить</button></div>",   $row['title'], $row['id'], $row['id']);
			}
			
			
			echo "</div>";
		}
	}
?>
