<?php

const ESTADO = "estado";
const DATOS = "Usuario";
const MENSAJE = "mensaje";

const CODIGO_EXITO = 1;
const CODIGO_FALLO = 2;

require 'usuarios.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	
	// Definir tipo de la respuesta
	header('Content-Type: application/json');
	
	switch ($_GET['BY']){
		case "ALL":
			// Obtener Usuarios de la base de datos
			$usuarios = Usuario::getAll();

			if ($usuarios) {
				$datos[ESTADO] = CODIGO_EXITO;
				$datos[DATOS] = $usuarios;
				print json_encode($datos);
			} else {
				print json_encode(array(
					ESTADO => CODIGO_FALLO,
					MENSAJE => "Ha ocurrido un error"
				));
			}
			break;
		case "EMAIL":
			// Obtener Usuarios de la base de datos
			$usuarios = Usuario::getUsuarioByEmail($_GET['EMAIL']);

			if ($usuarios) {
				$datos[ESTADO] = CODIGO_EXITO;
				$datos[DATOS] = $usuarios;
				print json_encode($datos);
			} else {
				print json_encode(array(
					ESTADO => CODIGO_FALLO,
					MENSAJE => "Ha ocurrido un error"
				));
			}
			break;
		case "ID":
			$usuarios = Usuario::getUsuarioByID($_GET['ID']);
			
			if($usuarios){
				$datos[ESTADO] = CODIGO_EXITO;
				$datos[DATOS] = $usuarios;
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