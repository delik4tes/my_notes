<?php
abstract class  MainClass{
	
	protected $db;
	
	public function _construct (){
	
		if($_COOKIE['user'] == ''){
			header("Location:/KR_WEB/registration.php");
		}
	
		$this->$db = mysqli_connect(HOST, USER, PASSWORD);
		if(!$this->db){
			exit("Ошибка соединения с базой данных".mysqli_error());
		}
		if(!mysqli_select_db(DB, $tris->db)){
			exit("Нет такой базы данных".mysqli_error());
		}
		
		mysqli_query("SET NAMES UTF8");
	}
	
	protected function get_header(){
		echo '<!DOCTYPE html>

			<HTML lang="ru"> 

			<HEAD>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>А-07-19 Женюх Александр</title>
				<link rel="stylesheet" href="/KR_WEB/style1.css">
			</HEAD>

			<BODY>
			    	<h1>Энциклопедия "В мире животных"</h1>';
	}

	protected function get_category(){
		$query = "SELECT id_animal_vid, name_animal_vid FROM animal_vid";
		$link = mysqli_connect(HOST, USER, PASSWORD, DB);
		$result = mysqli_query($link, $query);
		
		if(!$result){
			exit(mysqli_error($link));
		}
		
		$row = array();
		echo '<div class="widget">
		<ul class="widget-list"> 
		
			   <li><a href="/KR_WEB/registration.php">Выйти</a></li><br>
		           <li><a href="/KR_WEB/index.php"><b>Всё о животных</b></a></li><br>';
		           
		for ($i = 0; $i < mysqli_num_rows($result); $i++){
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC); //---последовательно считываем ряды результата
			printf("<li class='categories'>
				<a href='?option=animal_vid&id_cat=%s'>%s</a>
				</li>",  $row['id_animal_vid'], $row['name_animal_vid']);
		}
			

		echo '	</ul></div>
			<br>';
	}	
	
	
	public function get_body() {
		$this->get_header();
		$this->get_category();
		$this->get_content();
	}
	
	abstract function get_content();
}
?>
