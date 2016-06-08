<?php 


class Usuario{
	private $nidUsuario;
	private $snombre;
	private $susuario;
	private $sclave;
        private $stipoUsuario;
	        
	function __construct($snom,$susr,$sclave,$tipoUsuario){
		$this->snombre=$snom;
		$this->susuario=$susr;
		$this->sclave=md5($sclave);
                $this->stipoUsuario=$stipo;
                
	}
	public function getNombre(){
		return $this->snombre;
	}

	public function getIdacceso(){
		return $this->nidUsuario;
	}
        
        public function getNidacceso() {
            return $this->nidUsuario;
        }

        public function getSnombre() {
            return $this->snombre;
        }

        public function getSusuario() {
            return $this->susuario;
        }

        public function getSclave() {
            return $this->sclave;
        }

        public function getStipoUsuario() {
            return $this->stipoUsuario;
        }

        
        
	function VerificaUsuario(){
		$db=dbconnect();
		$sqlsel="select nombreUsuario from usuario
		where user=:usr";

		$querysel=$db->prepare($sqlsel);


		$querysel->bindParam(':usr',$this->susuario);
		
		$datos=$querysel->execute();
		
		if ($querysel->rowcount()==1)return true; else return false;

	}

	function VerificaAcceso(){
		$db=dbconnect();
		$sqlsel="select idUsuario,nombreUsuario from usuario
		where nomusuario=:usr and pwdusuario=:pwd";

		$querysel=$db->prepare($sqlsel);

		$querysel->bindParam(':usr',$this->susuario);
		$querysel->bindParam(':pwd',$this->sclave);

		$datos=$querysel->execute();

		if ($querysel->rowcount()==1){
                    
                    $registro = $querysel->fetch();
                    
                    $this->snombre=$registro['nombreUsuario'];
                    $this->nidUsuario=$registro['idUsuario'];
			return true;
		}
		else{
			return false;
		}


	}
	function ActualizaClave($snewpwd){
		$db=dbconnect();

		$sqlupd="update usuario set pass=:pwd
					where idUsuario=:id";

		$querysel=$db->prepare($sqlupd);

		$querysel->bindParam(':pwd',($snewpwd));
		$querysel->bindParam(':id',$this->nidUsuario);
		

		$valaux=$querysel->execute();
	
		return $valaux;
	}

}
?>
