<?php 

$nome = $_POST['pessoa'];
$idade = $_POST['idade'];
$email = $_POST['email'];

$id = $_POST['id'];

//echo $nome." - ".$idade." - ".$email." - ".$id."<br>";


	include_once("conect.php");
	include_once("Crud.php");

$obj = new Crud($conect);

$obj->update($id,$nome,$idade,$email);
?>