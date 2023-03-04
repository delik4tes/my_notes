<?php
abstract class AdminMainClass{
	
	protected $db;
	
	public function _construct (){
	
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
				<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

			</HEAD>
				
			<BODY>
			<h1>Энциклопедия "В мире животных"</h1>';
	}
	protected function get_category(){

		echo '<div class="widget">
		<ul class="widget-list">';
		echo '<li><a href="/KR_WEB/registration.php">Выйти</a></li><br>';    
		echo '<li><a href="?option=redactor">Редактировать главы</a></li>';
		echo '<li><a href="?option=add_posts">Добавить новую главу</a></li>';
		echo '<li><a href="?option=edit_animal_vid">Редактировать виды животных</a></li>';
		echo '<li><a href="?option=add_animal_vid">Добавить виды животных</a></li>';
		echo '</ul></div>';
	}	
	
	public function get_body() {
	
		if($_GET['del_text'] || $_POST){
			$this->edit();
		}
		
		$this->get_header();
		$this->get_category();
		$this->get_content();
	}
	
	abstract function get_content();
	
	protected function get_animal_vid(){
		$query = "SELECT id_animal_vid, name_animal_vid FROM animal_vid";
		$link = mysqli_connect(HOST, USER, PASSWORD, DB);
		$result = mysqli_query($link, $query);
		if(!$result){				
			exit(mysqli_error($link));
		}
		
		$row = array();
		for ($i = 0; $i < mysqli_num_rows($result); $i++){
			$row[] = mysqli_fetch_array($result, MYSQLI_ASSOC);
		}
		
		return $row;
	}
	
	protected function get_text_posts($id){
		$query = "SELECT id, title, discription, text, cat, img_src
		 	  FROM posts
		 	  WHERE id='$id'";
		$link = mysqli_connect(HOST, USER, PASSWORD, DB);
		$result = mysqli_query($link, $query);
		if(!$result){				
			exit(mysqli_error($link));
		}
		
		$row = array();
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		return $row;
	}
	
	protected function get_name_animal_vid($id){
		$query = "SELECT id_animal_vid, name_animal_vid
		 	  FROM animal_vid
		 	  WHERE id_animal_vid='$id'";
		$link = mysqli_connect(HOST, USER, PASSWORD, DB);
		$result = mysqli_query($link, $query);
		if(!$result){				
			exit(mysqli_error($link));
		}
		
		$row = array();
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		return $row;
	}
}
?>
