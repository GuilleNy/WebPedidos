<?php
require __DIR__ . '/vendor/autoload.php';

use Adyen\Client;
use Adyen\Service\Checkout;

// Configuración del cliente
$client = new Client();
$client->setXApiKey("AQEshmfxLYrIbhJLw0m/n3Q5qf3Vf45PHZZOUWFZ1YdU/Vpvhcjfo6JPcKGuP8IQwV1bDb7kfNy1WIxIIkxgBw==-wNNg3lTre0hd+x4CrKMEjyjgw3ipz2EzEwQL1vQb7A4=-i1i2]62sI,JY.Q>Kbbm");
$client->setEnvironment("TEST"); // modo prueba

// Crear servicio de Checkout
$checkout = new Checkout($client);

// Crear la sesión de pago
$response = $checkout->sessions([
    "merchantAccount" => "WebpedidosECOM",
    "amount" => [
        "currency" => "EUR",
        "value" => 1000 // 10,00 EUR
    ],
    "reference" => "PEDIDO_" . time(),
    "returnUrl" => "http://localhost/miProyecto/resultado.php" //cambiar esto
]);

// Devolver la sesión al frontend
echo json_encode($response);
?>

