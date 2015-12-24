<?php
/**
 * Insertar un nuevo gasto en la base de datos
 */

// Constantes para construir la respuesta
const ESTADO = 'estado';
const MENSAJE = 'mensaje';
const ID_HIDRANTES = "idHidrante";

const CODIGO_EXITO = '1';
const CODIGO_FALLO = '2';

require 'hidrantes.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Insertar gasto
    $idHidrante = Hidrante::insertRow($body);

    if ($idHidrante) {
        // C�digo de �xito
        print json_encode(
            array(
                ESTADO => CODIGO_EXITO,
                MENSAJE => 'Creaci�n �xitosa',
                ID_GASTO => $idHidrante)

        );
    } else {
        // C�digo de falla
        print json_encode(
            array(
                ESTADO => CODIGO_FALLO,
                MENSAJE => 'Creaci�n fallida')
        );
    }
}