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
        // Código de éxito
        print json_encode(
            array(
                ESTADO => CODIGO_EXITO,
                MENSAJE => 'Creación éxitosa',
                ID_GASTO => $idHidrante)

        );
    } else {
        // Código de falla
        print json_encode(
            array(
                ESTADO => CODIGO_FALLO,
                MENSAJE => 'Creación fallida')
        );
    }
}