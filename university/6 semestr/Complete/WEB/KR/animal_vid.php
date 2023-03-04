<?php
 
class animal_vid extends MainClass{
	public function get_content(){
		
		echo '<div id="cont"><hr>';
						
						
		if(!$_GET['id_cat']){
			echo 'Неправильные данные для вывода статьи';
		}
		else{
			$id_cat = (int)$_GET['id_cat'];
			if(!$id_cat){
				echo 'Неправильные данные для вывода статьи';
			}
			else{
				$link = mysqli_connect(HOST, USER, PASSWORD, DB);
				$query = "SELECT id, title, text, discription, date, img_src 
					  FROM posts 
					  WHERE cat='$id_cat' 
					  ORDER BY date DESC";
				$result = mysqli_query($link, $query);
				if(!$result){
					exit(mysqli_error($link));
				}
				
				$row = array();
				for ($i = 0; $i < mysqli_num_rows($result); $i++){
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
			printf("<div style='margin:10px;border-bottom:2px solid #c2c2c2'>
			<b><p style='font-size: 36px'>%s</p></b>
			<p>%s</p>
			<img width='600px' align='centre' src='%s'>
			<p>%s</p>
			<p>%s</p>
			</div>",   $row['title'], $row['discription'], $row['img_src'], $row['text'], $row['date']);
					}
			}
		}
			
		echo '</div>';
	
	}
}
?>
