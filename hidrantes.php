<?php


require_once 'conexion.php';

class Hidrante
{
    // Nombre de la tabla asociada a esta clase
    const TABLE_NAME = "Hidrantes";

    const ID = "_id";

    const NOMBRE = "nombre";

    const POSICION = "posicion";

    const ESTADO = "estado";
	
	const PSI = "psi";
	
	const T4 = "t4";
	
	const T25 = "t25";
	
	const ACOPLE = "acople";
	
	const FOTO = "foto";
	
	const OBS = "obs";
	
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
                self::NOMBRE . "," .
                self::POSICION . "," .
                self::ESTADO . "," .
				self::PSI . "," .
				self::T4 . "," .
				self::T25 . "," .
				self::ACOPLE . "," .
				self::FOTO . "," .
				self::OBS 
                . ")" .
                " VALUES(?,?,?,?,?,?,?,?,?)";

            // Preparar la sentencia
            $sentencia = $pdo->prepare($comando);

            $sentencia->bindParam(1, $nombre);
            $sentencia->bindParam(2, $posicion);
            $sentencia->bindParam(3, $estado);
			$sentencia->bindParam(1, $psi);
            $sentencia->bindParam(4, $t4);
			$sentencia->bindParam(1, $t25);
            $sentencia->bindParam(2, $acople);
            $sentencia->bindParam(3, $foto);
            $sentencia->bindParam(4, $obs);

            $nombre = $object[self::NOMBRE];
            $posicion = $object[self::POSICION];
            $estado = $object[self::ESTADO];
			$estado = $object[self::PSI];
            $t4 = $object[self::T4];
			$t25 = $object[self::T25];
			$acople = $object[self::ACOPLE];
            $foto= $object[self::FOTO];
            $obs = $object[self::OBS];

            $sentencia->execute();

            // Retornar en el último id insertado
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }

    }
}

?>