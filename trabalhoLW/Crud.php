<?php 

class Crud{
	
	private $connect;

	private $nome;
	private $email;
	private $idade;

	function __construct($conect){
		
		$this->connect = $conect;
	}

	public function setDados($nome,$mail,$idade){

		$this->nome = $nome;
		$this->email = $mail;
		$this->idade = $idade;
	}
//Inserir
	public function insertDados(){

		$sql = $this->connect->prepare("INSERT INTO clientes(nome,idade,email,data_now) VALUES(?,?,?,now())");

		$sql->bindParam(1,$this->nome);
		$sql->bindParam(2, $this->idade);
		$sql->bindParam(3, $this->email);

		if($sql->execute()){
			echo "OK";
		} else{
			echo "Erro!";
		}
	}//end insertDados


//Ler
	
	public function readInfo($id = null){ // $nome

		if(isset($id)){
			$sql = $this->connect->prepare("SELECT * FROM clientes WHERE id=?"); //nome LIKE ?

			$sql->bindValue(1,$id); // "%$nome%"

			$sql->execute();

			$result = $sql->fetch(PDO::FETCH_OBJ);

			return $result;

		} else{

			$this->getAll();
		}

	}//end readInfo

	public function getAll(){

		$sql = $this->connect->query("SELECT * FROM clientes");

		return $sql->fetchAll();
	
		 
	} 

// Fazer Pesquisa

	public function readInfoAll($nome = null){

		if (isset($nome)) {
			$sql = $this->connect->prepare("SELECT * FROM clientes WHERE nome LIKE ?");

			$sql->bindValue(1,"%$nome%");

			$sql->execute();

			$result = $sql->fetchAll(PDO::FETCH_ASSOC);

			return $result;
			
		} else{

			$this->getAll();
		}

	}


//Update

	public function update($id,$nome,$idade,$email){

		$sql = $this->connect->prepare("UPDATE clientes SET nome=?, idade=?, email=? WHERE id=?");

		$sql->bindParam(1,$nome,PDO::PARAM_STR);
		$sql->bindParam(2,$idade,PDO::PARAM_STR);
		$sql->bindParam(3,$email,PDO::PARAM_STR);
		$sql->bindParam(4,$id,PDO::PARAM_STR);

		if($sql->execute()){

			echo "Registro Atualizado! <br> <a href='readAll.php'> Voltar </a>";
		} else{

			echo "Problemas ao tentar atualizar o registro! <br> <a href='readAll.php'> Voltar </a>";
		}

	}//end update

//Delete

	public function delete($id){

		$sql = $this->connect->prepare("DELETE FROM clientes WHERE id=?");

		$sql->bindParam(1,$id,PDO::PARAM_STR);

		if($sql->execute()){

			echo "Registro Excluído! <br> <a href='readAllDelete.php'> Voltar </a>";
		} else{

			echo "Problemas ao tentar atualizar o registro! <br> <a href='readAllDelete.php'> Voltar </a>";
		}

	}//end delete

}//end classe


?>