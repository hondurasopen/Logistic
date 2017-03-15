

<?PHP

include("Conexion.php");
class Clase{
	var $codigoClase,$descripcion;
	/**
	 * Constructor
	 */

	function __construct($codigoClase=0,$descripcion=""){
		$this->establecerValores($codigoClase,$descripcion);
	}

	function establecerValores($codigoClase,$descripcion){
		$this->codigoClase=$codigoClase;
		$this->descripcion=$descripcion;
	
	}
	function agregarClase(){
		$objConexion=new Conexion("Tellevo","localhost","root","");
		if(!$objConexion->ejecutarComando("INSERT INTO TBL_MG_CLASES_UNIDADES_TRANSPORTE VALUES(".$this->codigoClase.",'".$this->descripcion."')")){
			echo "No se pudo agregar el clase";
			exit();
		}
		$objConexion->cerrarConexion();
	}
	function eliminarClase(){
		$objConexion=new Conexion("Tellevo","localhost","root","");
		if(!$objConexion->ejecutarComando("DELETE FROM  TBL_MG_CLASES_UNIDADES_TRANSPORTE WHERE CODIGO_CLASE=".$this->codigoClase)){
			echo "No se pudo Eliminar el administrador";
			exit();
		}
		$objConexion->cerrarConexion();
	}
	
	/*Funciones de Acceso*/
	function obtenerCodigo(){
		return $this->codigoClase;
	}
	function establecerCodigo($codigo){
		$this->codigoClase=$codigo;
		
	}
	
	function obtenerDescripcion(){
		return $this->descripcion;
	}
	function establecerDescripcion($descrip){
		$this->descripcion=$descrip;
		
	}
	
	
	
}
?>
