<?php


require_once 'conexion.php';

class Usuario
{
    // Nombre de la tabla asociada a esta clase
    const TABLE_NAME = "Usuario";

    const ID = "id_cedula";

    const NOMBRE = "nombre";

    const APELLIDO = "apellido";

    const TIPO = "tipo";
	
	const INSTITUCION = "institucion";
	
	const CARGO= "cargo";
	
	const PASSWORD = "password";
	
	const ESTADO = "estado";
	
	const EMAIL = "email";
	
    function __construct()
    {
    }

    /**
     * Obtiene todos los gastos de la base de datos
     * @return array|bool Arreglo con todos los gastos o false en caso de error
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM " . self::TABLE_NAME;
        try {
            // Preparar sentencia
            $comando = DatabaseConnection::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
	
	public static function getUsuarioByID($id){
		$consulta = "SELECT * FROM ".self::TABLE_NAME." WHERE id_cedula = ".$id;
		
		 try {
            // Preparar sentencia
            $comando = DatabaseConnection::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
	}
	
	public static function getUsuarioByEmail($email){
		$consulta = "SELECT * FROM ".self::TABLE_NAME." WHERE email = '".$email."'";
		
		 try {
            // Preparar sentencia
            $comando = DatabaseConnection::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
	}

    public static function insertRow($object)
    {
        try {

            $pdo = DatabaseConnection::getInstance()->getDb();

				            // Sentencia INSERT
				$comando = "INSERT INTO " . self::TABLE_NAME . " ( " .
				self::ID . ",".
                self::NOMBRE . "," .
                self::APELLIDO . "," .
                self::TIPO . "," .
				self::INSTITUCION . "," .
				self::CARGO . "," .
				self::PASSWORD . "," .
				self::ESTADO . "," .
				self::EMAIL . "," 
                . ")" .
                " VALUES(?,?,?,?,?,?,?,?,?)";
				
				 // Preparar la sentencia
				$sentencia = $pdo->prepare($comando);
				
				$id_cedula = $object[self::ID];
				$nombre = $object[self::NOMBRE];
				$apellido = $object[self::APELLIDO];
				$tipo = $object[self::TIPO];
				$institucion = $object[self::INSTITUCION];
				$cargo = $object[self::CARGO];
				$password = $object[self::PASSWORD];
				$estado = $object[self::ESTADO];
				$email= $object[self::EMAIL];

				$sentencia->bindParam(1, $id_cedula);
				$sentencia->bindParam(2, $nombre);
				$sentencia->bindParam(3, $apellido);
				$sentencia->bindParam(4, $tipo, PDO::PARAM_INT);
				$sentencia->bindParam(5, $institucion);
				$sentencia->bindParam(6, $cargo);
				$sentencia->bindParam(7, $password);
				$sentencia->bindParam(8, $estado);
				$sentencia->bindParam(9, $email);

				$sentencia->execute();
			
				// Retornar en el último id insertado
				return $pdo->lastInsertId();	
           
        } catch (PDOException $e) {
			$PDOerror = fopen("PDOerror.txt", "w");
			fwrite($PDOerror, $e->getTraceAsString());
			fclose($PDOerror);
            return false;
        }

    }
}

?>