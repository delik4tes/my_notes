<?php

class delete_posts extends AdminMainClass{

	public function edit(){
		if ($_GET['del_text']){
			$id_text = (int)$_GET['del_text'];
			
			$query = "DELETE FROM posts 
				  WHERE id='$id_text'";
				  
			$link = mysqli_connect(HOST, USER, PASSWORD, DB);
			$result = mysqli_query($link, $query);
			if($result){
				$_SESSION['res']="Статья успешно удалена";
				header("Location:?option=redactor");
				exit();
			}
			else{
				exit("Ошибка удаления статьи");
			}	  
			
		}
		else {
			exit("Неверные данные для отображения страницы");
		}
	}	
	
	public function get_content(){}
}

?>
