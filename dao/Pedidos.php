<?php 
	
	/**
	 * 
	 */
	class Pedidos
	{

		private $id;
		private $nombreCliente;
		private $telefono;
		private $montoFinal;
		private $fecha;
		private $id_estado;
		
		//____________________________________________________________Modelo

		function __construct($id,$nombreCliente,$telefono,$montoFinal,$fecha,$id_estado)
		{
			$this->id=$id;
			$this->nombreCliente=$nombreCliente;
			$this->telefono=$telefono;
			$this->montoFinal=$montoFinal;
			$this->fecha=$fecha;
			$this->id_estado=$id_estado;
		}

		//SETTERS
		public function setId($id){
			$this->id=$id;
		}

		public function setNombreCliente($nombreCliente){
			$this->nombreCliente=$nombreCliente;
		}

		public function setTelefono($telefono){
			$this->telefono=$telefono;
		}

		public function setMontoFinal($montoFinal){
			$this->montoFinal=$montoFinal;
		}

		public function setFecha($fecha){
			$this->fecha=$fecha;
		}

		public function setId_estado($id_estado){
			$this->id_estado=$id_estado;
		}


		//GETTERS
		public function getId(){
			return $this->id;
		}

		public function getNombreCliente(){
			return $this->nombreCliente;
		}

		public function getTelefono(){
			return $this->telefono;
		}

		public function getMontoFinal(){
			return $this->montoFinal;
		}

		public function getFecha(){
			return $this->fecha;
		}

		public function getId_estado(){
			return $this->id_estado;
		}



		//________________________________________________Controlador

		public function setConexion($conexion){
			$this->conexion=$conexion;
		}	


		public function createPedido(){
			$query=
			"INSERT INTO 
				pedidos
			SET 
				nombreCliente=:nombreCliente,
				telefono=:telefono,
				montoFinal=:montoFinal,
				id_estado=:id_estado";

			$stmt=$this->conexion->prepare($query);

			$this->nombreCliente=htmlspecialchars($this->nombreCliente);
			$stmt->bindParam(":nombreCliente",$this->nombreCliente);

			$this->telefono=htmlspecialchars($this->telefono);
			$stmt->bindParam(":telefono",$this->telefono);

			$this->montoFinal=htmlspecialchars($this->montoFinal);
			$stmt->bindParam(":montoFinal",$this->montoFinal);

			$this->id_estado=htmlspecialchars($this->id_estado);
			$stmt->bindParam(":id_estado",$this->id_estado);


			if($stmt->execute()){
				return true;
			}else{
				//echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readPedidos(){
			$pedido= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM pedidos";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row);
					array_push($pedido, new Pedidos($id,$nombreCliente,$telefono,$montoFinal,$fecha,$id_estado));
				}
				return $pedido;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}

		public function readPedidoID(){
			$ventas= array();//nombre de la variable y su valor
			$query=
			"SELECT 
				*
			FROM pedidos
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				$this->id=$id;
				$this->nombreCliente=$nombreCliente;
				$this->telefono=$telefono;
				$this->montoFinal=$montoFinal;
				$this->fecha=$fecha;
				$this->id_estado=$id_estado;
			}else{
				echo "Error:  ".$stmt->errorInfo();
				return false;
			}
		}


		public function updatePedido(){
			$query=
			"UPDATE  
				pedidos
			SET 
				nombreCliente=:nombreCliente,
				telefono=:telefono,
				montoFinal=:montoFinal,
				id_estado=:id_estado

			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			$this->nombreCliente=htmlspecialchars($this->nombreCliente);
			$stmt->bindParam(":nombreCliente",$this->nombreCliente);

			$this->telefono=htmlspecialchars($this->telefono);
			$stmt->bindParam(":telefono",$this->telefono);

			$this->montoFinal=htmlspecialchars($this->montoFinal);
			$stmt->bindParam(":montoFinal",$this->montoFinal);

			$this->id_estado=htmlspecialchars($this->id_estado);
			$stmt->bindParam(":id_estado",$this->id_estado);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}



		public function updatePedidoMontoFinal(){
			$query=
			"UPDATE  
				pedidos
			SET 
				montoFinal=:montoFinal

			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			$this->montoFinal=htmlspecialchars($this->montoFinal);
			$stmt->bindParam(":montoFinal",$this->montoFinal);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}



		public function deletePedido(){
			$query=
			"DELETE FROM 
				pedidos
			WHERE id=$this->id";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function maxID(){
			$query=
			"SELECT 
				MAX(id) AS maximo
			FROM pedidos";

			$stmt=$this->conexion->prepare($query);

			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				extract($row);
				return $maximo;
			}else{
				return false;
			}
		}



		public function totalPedidos(){
			$query=
			"SELECT COUNT(id) as total 
			FROM pedidos";

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