<?php
 
class reader extends MainClass{
	public function get_content(){
		
		$link = mysqli_connect(HOST, USER, PASSWORD, DB);
		$query = "SELECT id, title, discription, date, text, img_src FROM posts ORDER BY date DESC";
		$result = mysqli_query($link, $query);
		if(!$result){
			exit(mysqli_error($link));
		}
		
		echo "<div id='cont'><hr>";
		
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
		echo '</div>';
	}
}
?>
