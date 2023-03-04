<?php
	class edit_posts extends AdminMainClass {
	
		protected function edit(){
			
			if(!empty($_FILES['img_src']['tmp_name'])){
				if(!move_uploaded_file($_FILES['img_src']['tmp_name'], '/var/www/kr/KR_WEB/img/'.$_FILES['img_src']['name'])){
					exit("Не удалось загрузить изображение");
				}
				$img_src = '/KR_WEB/img/'.$_FILES['img_src']['name'];
			}
			else{
				exit("Необходимо загрузить изображение");
			}
			
			$id = $_POST['id'];
			$title = $_POST['title'];
			$date = date("y-m-d", time());
			$discription = $_POST['discription'];
			$text = $_POST['text'];
			$cat = $_POST['cat'];
			
			if( empty($title) || empty($text) || empty($discription) ){
				exit("Не заполнены обязательные поля");
			}
						
			$query = "UPDATE posts 
				  SET title='$title', img_src='$img_src', date='$date', text='$text', discription='$discription', cat='$cat' 
				  WHERE id='$id'";
				  
			$link = mysqli_connect(HOST, USER, PASSWORD, DB);
			$result = mysqli_query($link, $query);
			if(!$result){
				exit(mysqli_error($link));
			}
			else {
				$_SESSION['res'] = "Изменения сохранены";
				header("Location:?option=redactor");
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
			
			$text = $this->get_text_posts($id_text);
			
			echo "<div id='cont'>";
			
			if($_SESSION['res']){
				echo $_SESSION['res'];
				unset($_SESSION['res']);
			}
		
			$cat = $this->get_animal_vid();
			
			print <<<HEREDOC
			<form enctype="multipart/form-data" action="" method="POST">
				<p><b>Название животного:</b><br>
				<textarea id='editor_title' type='text' name='title'>$text[title]</textarea>
				<input type='hidden' name='id' style='width:420px;' value='$text[id]'>
				</p>
				
				<p><b>Краткое описание животного:</b><br>
				<textarea id='editor_disk' type='text' name='discription'>$text[discription]</textarea>
				</p>

				<p><b>Полное описание животного:</b><br>
				<textarea id='editor_text' name='text'>$text[text]</textarea>
				</p>
				
				<p><b>Фото:</b><br>
				<input type='file' name='img_src'>
				</p>
				
				<p><b>Категория, к которой относится животное:</b><br>
				<select name='cat'>
			HEREDOC;
			foreach($cat as $item){
				if($text['cat'] == $item['id_animal_vid']){
					echo "<option selected value='".$item['id_animal_vid']."'>".$item['name_animal_vid']."</option>";
				}	
				else {
					echo "<option value='".$item['id_animal_vid']."'>".$item['name_animal_vid']."</option>";
				}
				
			}
			echo "</select><p><input type='submit' name='button' value='Сохранить'></p></form>
			
			<script>
				ClassicEditor
					.create(document.querySelector('#editor_title'))
					.catch(error=>{
						console.error(error)
					});
			</script>
			
			<script>
				ClassicEditor
					.create(document.querySelector('#editor_disk'))
					.catch(error=>{
						console.error(error)
					});
			</script>
			
			<script>
				ClassicEditor
					.create(document.querySelector('#editor_text'))
					.catch(error=>{
						console.error(error)
					});
			</script>
			
			</div>";
			
		}
	}
?>
