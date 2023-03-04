<?php

class delete_animal_vid extends AdminMainClass{

	public function edit(){
		if ($_GET['del_text']){
			$id_category = (int)$_GET['del_text'];
			
			$query = "DELETE FROM animal_vid
				  WHERE id_animal_vid='$id_category'";
				  
			$link = mysqli_connect(HOST, USER, PASSWORD, DB);
			$result = mysqli_query($link, $query);
			if($result){
				$_SESSION['res']="Категория успешно удалена";
				header("Location:?option=edit_animal_vid");
				exit();
			}
			else{
				exit("Ошибка удаления категории");
			}	  
			
		}
		else {
			exit("Неверные данные для отображения страницы");
		}
	}	
	
	public function get_content(){
	
	}
}

?>
