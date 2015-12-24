<?php
/**
 * Obtiene todos los gastos de la base de datos
 */

/**
 * Constantes para construcci�n de respuesta
 */
const ESTADO = "estado";
const DATOS = "hidrantes";
const MENSAJE = "mensaje";

const CODIGO_EXITO = 1;
const CODIGO_FALLO = 2;

require 'hidrantes.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Obtener gastos de la base de datos
    $hidrantes = Hidrante::getAll();

    // Definir tipo de la respuesta
    header('Content-Type: application/json');

    if ($hidrantes) {
        $datos[ESTADO] = CODIGO_EXITO;
        $datos[DATOS] = $hidrantes;
        print json_encode($datos);
    } else {
        print json_encode(array(
            ESTADO => CODIGO_FALLO,
            MENSAJE => "Ha ocurrido un error"
        ));
    }
}