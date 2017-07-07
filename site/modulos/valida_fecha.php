
<?php

ini_set('display_errors', 0);
include_once "../includes/i_funciones.php";


if (isset($_POST['agencia'])) {
    $tp_agencia = execute_sql("get_fecha_restringida_cita", array($_POST['agencia']));

    $_opc_tp_banco = '';
    foreach ($tp_agencia as $agenc) {
        $agenc = explode("/", $agenc['fecha']);
        $_opc_tp_banco .= '"' . $agenc[2] . '-' . $agenc[1] . '-' . $agenc[0] . '",';
    }


    echo $_opc_tp_banco;
}

if (isset($_POST['fecha'])) {
    $tp_agencia = execute_sql("get_fecha_restringida_cita_2", array($_POST['fecha']));

    $_opc_tp_banco = '';
    foreach ($tp_agencia as $agenc) {
        $agenc = explode("/", $agenc['fecha']);
        $_opc_tp_banco .= '"' . $agenc[2] . '-' . $agenc[1] . '-' . $agenc[0] . '",';
    }


    echo $_opc_tp_banco;
}