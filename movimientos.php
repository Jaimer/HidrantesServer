<?php

/**
 * Representa el data de los gastos
 * almacenados en la base de datos
 */
require_once 'conexion.php';

class Movimiento
{
    // Nombre de la tabla asociada a esta clase
    const TABLE_NAME = "Movimientos";

    const IDMOV = "idmov";

    const ID_HIDRANTE = "id_hidrante";
	
	const fecha_mod = "fecha_mod";
	
	const USUARIO_MOD = "usuario_mod";
	
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

    public static function insertRow($object)
    {
        try {

            $pdo = DatabaseConnection::getInstance()->getDb();

            // Sentencia INSERT
            $comando = "INSERT INTO " . self::TABLE_NAME . " ( " .
                self::ID_HIDRANTE . "," .
                self::fecha_mod . ",".
                self::USUARIO_MOD . ")" .
                " VALUES(?,?,?)";

            // Preparar la sentencia
            $sentencia = $pdo->prepare($comando);
			
			$id_hidrante = $object[self::ID_HIDRANTE];
            $fecha_mod = $object[self::fecha_mod];
            $usuario_mod = $object[self::USUARIO_MOD];

            $sentencia->bindParam(1, $id_hidrante);
            $sentencia->bindParam(2, $fecha_mod);
            $sentencia->bindParam(3, $usuario_mod);

            $sentencia->execute();

            // Retornar en el último id insertado
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            return $e->getTrace();
        }

    }
	
	public static function getRows(){
		$consulta = "SELECT COUNT(*) AS Filas FROM " . self::TABLE_NAME; //Se agrega alias para que el resultado Json tenga un titulo
		
		try{
			// Preparar sentencia
            $comando = DatabaseConnection::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			return false;
		}
	}
	
	public static function getLastMovs($cantidad){
		$consulta = "SELECT * FROM ".self::TABLE_NAME." ORDER BY idmov DESC LIMIT ".$cantidad;
		
		try{
			$comando = DatabaseConnection::getInstance()->getDb()->prepare($consulta);
			$comando->execute();
			
			return $comando->fetchAll(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			return false;
		}
	}
}

?>