<?php

	/**
	 * Esta es la clase de categoria
	 */
	class Categoria
	{
		
		private $id;
		private $categoria;

		//________________________________________________Modelo

		function __construct($id,$categoria)
		{
			$this->id=$id;
			$this->categoria=$categoria;
		}


		//SETTERS
		public function setId($id){
			$this->id=$id;
		}

		public function setCategoria($categoria){
			$this->categoria=$categoria;
		}

		//GETTERS
		public function getId(){
			return $this->id;
		}

		public function getCategoria(){
			return $this->categoria;
		}



		//________________________________________________Controlador

		public function setConexion($conexion){
			$this->conexion=$conexion;
		}

		//C = create, R = read, U = update, D = delete

		public function createCategoria(){
			$query=
			"INSERT INTO 
				categoria
			SET 
				categoria=:categoria";

			$stmt=$this->conexion->prepare($query);
			
			$this->categoria=htmlspecialchars($this->categoria);
			$stmt->bindParam(":categoria",$this->categoria);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function readCategoria(){
			$categorias= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM categoria";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($categorias, new Categoria($id,$categoria));
				}
				return $categorias;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readCategoriaID(){
			$categorias= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM categoria
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$this->categoria = $categoria;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function updateCategoria(){
			$query=
			"UPDATE  
				categoria
			SET 
				categoria=:categoria
			where id=$this->id";

			$stmt=$this->conexion->prepare($query);

			$this->categoria=htmlspecialchars($this->categoria);
			$stmt->bindParam(":categoria",$this->categoria);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCategoria(){
			$query=
			"DELETE FROM 
				categoria
			where id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}


		public function totalCategorias(){
			$query=
			"SELECT COUNT(id) as total 
			FROM categoria";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				return $total;
			}else{
				return false;
			}
		}

	}

?>