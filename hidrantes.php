<?php


require_once 'conexion.php';

class Hidrante{
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
	
    function __construct(){}

    /**
     * Obtiene todos los gastos de la base de datos
     * @return array|bool Arreglo con todos los gastos o false en caso de error
     */
    public static function getAll(){
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
	
	public static function getHidrante($id){
		$consulta = "SELECT * FROM ".self::TABLE_NAME." WHERE _id = ".$id;
		
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

    public static function insertRow($object){
        try {

            $pdo = DatabaseConnection::getInstance()->getDb();

			if($object[self::ID] == 0){
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
				
				$nombre = $object[self::NOMBRE];
				$posicion = $object[self::POSICION];
				$estado = $object[self::ESTADO];
				$psi = $object[self::PSI];
				$t4 = $object[self::T4];
				$t25 = $object[self::T25];
				$acople = $object[self::ACOPLE];
				$foto= $object[self::FOTO];
				$obs = $object[self::OBS];

				$sentencia->bindParam(1, $nombre);
				$sentencia->bindParam(2, $posicion);
				$sentencia->bindParam(3, $estado);
				$sentencia->bindParam(4, $psi, PDO::PARAM_INT);
				$sentencia->bindParam(5, $t4, PDO::PARAM_INT);
				$sentencia->bindParam(6, $t25, PDO::PARAM_INT);
				$sentencia->bindParam(7, $acople);
				$sentencia->bindParam(8, $foto);
				$sentencia->bindParam(9, $obs);

				$sentencia->execute();
			
				// Retornar en el último id insertado
				return $pdo->lastInsertId();
			
			}else{
				$comando = "UPDATE " . self::TABLE_NAME . " SET " .
                self::NOMBRE . "= :nombre, " .
                self::POSICION . "= :posicion, " .
                self::ESTADO . "= :estado, " .
				self::PSI . "= :psi, " .
				self::T4 . "= :t4, " .
				self::T25 . "= :t25, " .
				self::ACOPLE . "= :acople, " .
				self::FOTO . "= :foto, " .
				self::OBS . "= :obs " .
                " WHERE " .
				self::ID . "= :id ";
				
				 // Preparar la sentencia
				$sentencia = $pdo->prepare($comando);
				
				$id = $object[self::ID];
				$nombre = $object[self::NOMBRE];
				$posicion = $object[self::POSICION];
				$estado = $object[self::ESTADO];
				$psi = $object[self::PSI];
				$t4 = $object[self::T4];
				$t25 = $object[self::T25];
				$acople = $object[self::ACOPLE];
				$foto= $object[self::FOTO];
				$obs = $object[self::OBS];

				$sentencia->bindParam(':nombre', $nombre, PDO::PARAM_STR);
				$sentencia->bindParam(':posicion', $posicion, PDO::PARAM_STR);
				$sentencia->bindParam(':estado', $estado, PDO::PARAM_STR);
				$sentencia->bindParam(':psi', $psi, PDO::PARAM_INT);
				$sentencia->bindParam(':t4', $t4, PDO::PARAM_INT);
				$sentencia->bindParam(':t25', $t25, PDO::PARAM_INT);
				$sentencia->bindParam(':acople', $acople, PDO::PARAM_STR);
				$sentencia->bindParam(':foto', $foto, PDO::PARAM_STR);
				$sentencia->bindParam(':obs', $obs, PDO::PARAM_STR);
				$sentencia->bindParam(':id', $id, PDO::PARAM_INT);
				
				$sentencia->execute();
				
				// Retornar el id del hidrante actualizado
				return $id;
			}			
           
        } catch (PDOException $e) {
			$PDOerror = fopen("PDOerror.txt", "w");
			fwrite($PDOerror, $e->getTraceAsString());
			fclose($PDOerror);
            return false;
        }

    }
}

?>