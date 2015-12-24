<?php

const ESTADO = "estado";
const DATOS = "Movimientos";
const MENSAJE = "mensaje";

const CODIGO_EXITO = 1;
const CODIGO_FALLO = 2;

require 'movimientos.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	
	// Definir tipo de la respuesta
	header('Content-Type: application/json');
	
	switch ($_GET['TRA']){
		case "ALL":
			// Obtener gastos de la base de datos
			$movimientos = Movimiento::getAll();

			if ($movimientos) {
				$datos[ESTADO] = CODIGO_EXITO;
				$datos[DATOS] = $movimientos;
				print json_encode($datos);
			} else {
				print json_encode(array(
					ESTADO => CODIGO_FALLO,
					MENSAJE => "Ha ocurrido un error"
				));
			}
			break;
		case "ROW":
			// Obtener gastos de la base de datos
			$movimientos = Movimiento::getRows();

			if ($movimientos) {
				$datos[ESTADO] = CODIGO_EXITO;
				$datos[DATOS] = $movimientos;
				print json_encode($datos);
			} else {
				print json_encode(array(
					ESTADO => CODIGO_FALLO,
					MENSAJE => "Ha ocurrido un error"
				));
			}
			break;
		default:
			print json_encode(array(
					ESTADO => CODIGO_FALLO,
					MENSAJE => "Transacción Desconocida"
				));
	}
}