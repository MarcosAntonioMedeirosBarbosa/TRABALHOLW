<?php 

$nome = $_POST['nome'];
$email = $_POST['e-mail'];
$idade = $_POST['idade'];

// echo $nome." - ".$email." - ".$idade;

include_once("conect.php"); // importar o arquivo de conexão
include_once("Crud.php");	// importar arquivo da classe Crud

$obj = new Crud($conect);

$obj->setDados($nome,$email,$idade);

$obj->insertDados();





 ?>