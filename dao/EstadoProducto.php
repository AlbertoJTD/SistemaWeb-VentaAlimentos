<?php

	/**
	 * Esta es la clase de estadoProducto
	 */
	class EstadoProducto
	{
		
		private $id;
		private $estado;

		//________________________________________________Modelo

		function __construct($id,$estado)
		{
			$this->id=$id;
			$this->estado=$estado;
		}


		//SETTERS
		public function setId($id){
			$this->id=$id;
		}

		public function setEstado($estado){
			$this->estado=$estado;
		}

		//GETTERS
		public function getId(){
			return $this->id;
		}

		public function getEstado(){
			return $this->estado;
		}



		//________________________________________________Controlador

		public function setConexion($conexion){
			$this->conexion=$conexion;
		}

		//C = create, R = read, U = update, D = delete

		public function createEstado(){
			$query=
			"INSERT INTO 
				estadoProducto
			SET 
				estado=:estado";

			$stmt=$this->conexion->prepare($query);
			
			$this->estado=htmlspecialchars($this->estado);
			$stmt->bindParam(":estado",$this->estado);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function readEstado(){
			$estados= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM estadoProducto";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($estados, new EstadoProducto($id,$estado));
				}
				return $estados;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readEstadoID(){
			$categorias= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM estadoProducto
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$this->estado = $estado;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function updateEstado(){
			$query=
			"UPDATE  
				estadoProducto
			SET 
				estado=:estado
			where id=$this->id";

			$stmt=$this->conexion->prepare($query);

			$this->estado=htmlspecialchars($this->estado);
			$stmt->bindParam(":estado",$this->estado);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function deleteEstado(){
			$query=
			"DELETE FROM 
				estadoProducto
			where id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

	}

?>