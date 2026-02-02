<?php

require_once __DIR__ . '/config/adyen.php';
require_once __DIR__ . '/process_payment.php'; // esto ejecuta la creación de la sesión
// checkout_frontend.php


// Llamamos a process_payment.php para crear la sesión de pago

$adyenSession = $response;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago con Adyen - Frontend</title>

    <!-- CSS básico de Drop-in -->
    <link rel="stylesheet" href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/5.28.0/adyen.css" />

    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        #checkout-container { max-width: 500px; margin: auto; }
    </style>
</head>
<body>
<h2>Finalizar Pago</h2>

<div id="checkout-container"></div>

<!-- JS Drop-in de Adyen -->
<script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/5.28.0/adyen.js"></script>
<script>
    // Inicializar AdyenCheckout con la sesión creada en backend
    const checkout = new AdyenCheckout({
        clientKey: "<?= ADYEN_CLIENT_KEY ?>", // desde config/adyen.php
        locale: "es-ES",
        environment: "test",
        session: <?= json_encode($adyenSession) ?> // sesión creada por process_payment.php
    });

    // Crear y montar el Drop-in
    checkout.create('dropin').mount('#checkout-container');
</script>
</body>
</html>
