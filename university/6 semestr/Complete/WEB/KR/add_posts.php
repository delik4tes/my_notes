<?php

	class add_posts extends AdminMainClass {
	
		protected function edit(){
			
			if(!empty($_FILES['img_src']['tmp_name'])){
				if(!move_uploaded_file($_FILES["img_src"]["tmp_name"], "/var/www/kr/KR_WEB/img/".$_FILES['img_src']['name'])){
					exit("Не удалось загрузить изображение");
				}
				$img_src = '/KR_WEB/img/'.$_FILES['img_src']['name'];
			}
			else{
				exit("Необходимо загрузить изображение");
			}
			
			$title = $_POST['title'];
			$date = date("y-m-d");
			$discription = $_POST['discription'];
			$text = $_POST['text'];
			$cat = $_POST['cat'];
			
			if( empty($title) || empty($text) || empty($discription) ){
				exit("Не заполнены обязательные поля");
			}
			
			$query = "INSERT INTO posts
					(title, img_src, date, text, discription, cat)
				VALUES ('$title', '$img_src', '$date', '$text', '$discription', '$cat')";
			$link = mysqli_connect(HOST, USER, PASSWORD, DB);
			$result = mysqli_query($link, $query);
			if(!$result){
				exit(mysqli_error($link));
			}
			else {
				$_SESSION['res'] = "Изменения сохранены";
				header("Location:?option=add_posts");
				exit;
			}
		
		}
		
		public function get_content(){
			echo '<div id="cont">';
		
			if($_SESSION['res']){
				echo $_SESSION['res'];
				unset($_SESSION['res']);
			}
			
			$cat = $this->get_animal_vid();
			
			print <<<HEREDOC
			<form enctype="multipart/form-data" action="" method="POST">
				<p><b>Название животного:</b><br>
				<textarea id='editor_title' type='text' name='title'></textarea>
				</p>
				
				<p><b>Краткое описание животного:</b><br>
				<textarea id='editor_dis' name='discription'></textarea>
				</p>

				<p><b>Полное описание животного:</b><br>
				<textarea id='editor_text' name='text' cols='50' rows='7'></textarea>
				</p>
				
				<p><b>Фото:</b><br>
				<input type='file' name='img_src'>
				</p>
				
				<p><b>Категория, к которой относится животное:</b><br>
				<select name='cat'>
			HEREDOC;
			foreach($cat as $item){
				echo "<option value='".$item['id_animal_vid']."'>".$item['name_animal_vid']."</option>";
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
					.create(document.querySelector('#editor_dis'))
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
