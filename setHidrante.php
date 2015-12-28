<?php
/**
 * Insertar un nuevo gasto en la base de datos
 */

// Constantes para construir la respuesta
const ESTADO = 'estado';
const MENSAJE = 'mensaje';
const ID_HIDRANTE = "idHidrante";
const ID_MOVIMIENTO = "idmovimiento";

const CODIGO_EXITO = '1';
const CODIGO_FALLO = '2';

require 'hidrantes.php';
require 'movimientos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar gasto
    //$idHidrante = Hidrante::insertRow($body);
	$idHidrante = 1;

    if ($idHidrante) {
		//Crear movimiento
		$movimiento = array('id_hidrante' => $idHidrante,
										'fecha_mod' => date("Y-m-d H:i:s"),
										'usuario_mod' => 'jmoscoso');
		//$idMovimiento = Movimiento::insertRow($movimiento);
		$idMovimiento = 1;
		
		$movimiento = array("idmovimiento" => $idMovimiento)+$movimiento;
        // Código de éxito
        print json_encode(
            array(
                ESTADO => CODIGO_EXITO,
                MENSAJE => 'Creacion exitosa',
                'movimiento' => $movimiento)

        );
    } else {
        // Código de falla
        print json_encode(
            array(
                ESTADO => CODIGO_FALLO,
                MENSAJE => 'Creacion fallida')
        );
    }
}else{
	print "Error";
}