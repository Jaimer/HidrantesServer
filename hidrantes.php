<?php

/**
 * Representa el data de los gastos
 * almacenados en la base de datos
 */
require 'conexion.php';

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

	const fecha_crea = "fecha_crea";
	
	const fecha_mod = "fecha_mod";
	
	const fecha_insp = "fecha_insp";
	
	const fecha_man = "fecha_man";
	
	const USUARIO_CREA = "usuario_crea";
	
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
                self::NOMBRE . "," .
                self::POSICION . "," .
                self::ESTADO . "," .
				self::PSI . "," .
				self::T4 . "," .
				self::T25 . "," .
				self::ACOPLE . "," .
				self::FOTO . "," .
				self::OBS . "," .
				self::FECHA_CREA . "," .
				self::FECHA_MOD . "," .
				self::FECHA_INSP . "," .
				self::FECHA_MAN . "," .
				self::USUARIO_CREA . "," .
                self::USUARIO_MOD . ")" .
                " VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

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
            $sentencia->bindParam(2, $fecha_crea);
            $sentencia->bindParam(3, $fecha_mod);
            $sentencia->bindParam(4, $fecha_insp);
			$sentencia->bindParam(1, $fecha_man);
            $sentencia->bindParam(2, $usuario_crea);
            $sentencia->bindParam(3, $usuario_mod);

            $nombre = $object[self::NOMBRE];
            $posicion = $object[self::POSICION];
            $estado = $object[self::ESTADO];
			$estado = $object[self::PSI];
            $t4 = $object[self::T4];
			$t25 = $object[self::T25];
			$acople = $object[self::ACOPLE];
            $foto= $object[self::FOTO];
            $obs = $object[self::OBS];
			$fecha_crea = $object[self::FECHA_CREA];
            $fecha_mod = $object[self::FECHA_MOD];
            $fecha_insp = $object[self::FECHA_INSP];
			$fecha_man = $object[self::FECHA_MAN];
			$usuario_crea = $object[self::USUARIO_CREA];
            $usuario_mod = $object[self::USUARIO_MOD];

            $sentencia->execute();

            // Retornar en el último id insertado
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }

    }
}

?>