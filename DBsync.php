<?php

const ESTADO = "estado";
const DATOS = "Movimientos";
const MENSAJE = "mensaje";

const CODIGO_EXITO = 1;
const CODIGO_FALLO = 2;

require 'movimientos.php';
require 'hidrantes.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	
	header('Content-Type: application/json');
	
	$clientmovs = $_GET['NUM'];
	$servermovs = Movimiento::getRows()[0]['Filas'];
	$cambios = 0;
	$hidrantes = array();
	
			
	if($servermovs > $clientmovs){
		$cambios = $servermovs - $clientmovs;
		
		$movimientos = Movimiento::getLastMovs($cambios);
		foreach($movimientos as $movimiento){
			$hidrante = Hidrante::getHidrante($movimiento['id_hidrante']);
			array_push($hidrantes, $hidrante[0]);
		}
		
		print json_encode(
			array(
				ESTADO => CODIGO_EXITO,
				MENSAJE => 'Actualizacion Cliente',
				'Movimientos' => $movimientos,
				'Hidrantes' => $hidrantes));
	}elseif($servermovs < $clientmovs){
		$cambios = $clientmovs - $servermovs;
		
		print json_encode(
			array(
				ESTADO => CODIGO_EXITO,
				MENSAJE => 'Actualizacion Servidor',
				'Movimientos' => $cambios));
	}elseif($servermovs = $clientmovs){
		print json_encode(
			array(
				ESTADO => CODIGO_EXITO,
				MENSAJE => 'Sincronizado'));
	}else{
		print json_encode(array(
					ESTADO => CODIGO_FALLO,
					MENSAJE => "Ha ocurrido un error"
				));
	}
}