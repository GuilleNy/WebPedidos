<?php
session_start();
include_once "db/BBDD_pedidos.php";
include_once "consultas_db.php";
include_once "func_sesiones.php";
include "otras_funciones.php";

$data = json_decode(file_get_contents("php://input"), true);

$evento = $data['notificationItems'][0]['NotificationRequestItem'];

$referencia = $evento['merchantReference'];
$success = $evento['success'];


$cestaProductos = devolverCesta();
$numeroPago = depurar($_POST['pago']);
$orderLineNumber = 1;
$conn = conexion_BBDD();

if($success == "true"){

    $conn->beginTransaction();

    

    // Insertar detalles reales
    foreach ($cestaProductos as $productos => $detalles) {
            $idProducto = $detalles[0];
            $priceEach = $detalles[2];
            $cantidadProd = $detalles[3]; //3
            
            crearOrderDetails($conn, $codigoOrder , $idProducto, $cantidadProd, $priceEach, $orderLineNumber);
            actualizarCantidadProd($conn, $idProducto, $cantidadProd);
            $orderLineNumber++;
        }  
        crearPayments($conn, $numCli, $numeroPago, $date, $importeTotal);

    $conn->commit();
}

echo "[accepted]";







?>