<?php

$connect=mysqli_connect('localhost','root','','php_test') or die('Database connection error.'.mysqli_error($connect));
 
if(!isset($_GET['function'])){
	die('Some error occurred.');
}

function GetProducts($db){
	$sql = mysqli_query($db, 'SELECT * FROM products ORDER BY Id ASC');
	$data = array();
	
	if(mysqli_num_rows($sql) > 0){
		while($row = mysqli_fetch_array($sql)){
			$data[] = $row['Name'];
		}
	}
	$data = json_encode($data);
	echo $_GET['jsonCallback'].'('.$data.')';
}

if(function_exists($_GET['function'])){
	$_GET['function']($connect);
}
  
?>