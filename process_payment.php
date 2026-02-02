<?php

require_once __DIR__ . '/config/adyen.php';
require_once __DIR__ . '/vendor/autoload.php';

use Adyen\Client;
use Adyen\Environment;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\CreateCheckoutSessionRequest;
use Adyen\Service\Checkout\PaymentsApi;

// Recibimos datos opcionales del frontend
$orderReference = 'PEDIDO_'.time(); // puedes personalizarlo

// Crear cliente Adyen
$client = new Client();
$client->setXApiKey(ADYEN_API_KEY);
$client->setEnvironment(Environment::TEST);

// Crear solicitud de sesión de pago
$amount = new Amount();
$amount
  ->setCurrency("EUR")
  ->setValue(1000);
 
// Crear objeto de solicitud de sesión de pago
$createCheckoutSessionRequest = new CreateCheckoutSessionRequest(); 
$createCheckoutSessionRequest
  ->setReference('PEDIDO_' . time())
  ->setAmount($amount) // Monto del pago
  ->setMerchantAccount(ADYEN_MERCHANT) // Reemplaza con tu cuenta de comerciante
  ->setCountryCode("NL")
  ->setReturnUrl("http://localhost/WebPedidos/resultado.php"); // URL de retorno después del pago
 
$requestOptions['idempotencyKey'] = 'UUID';
 
// Crear sesión de pago
try {
    $service = new PaymentsApi($client);
    $response = $service->sessions($createCheckoutSessionRequest, $requestOptions); // Llamada a la API de Adyen
    $_SESSION['adyen_response'] = $response;
    // Si todo fue bien, muestra la respuesta

    echo '<pre>';
    print_r($response); // Muestra la respuesta de Adyen
    echo '</pre>';

} catch (\Adyen\AdyenException $e) {
    // Si hay un error, captura el error y muestra detalles
    echo "Error: " . $e->getMessage();  // Muestra el mensaje del error
    var_dump($e->getTrace());  // Muestra el seguimiento de la pila de errores
}

?>