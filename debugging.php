<?php
require_once __DIR__ . '/vendor/autoload.php';
use Adyen\Client;
use Adyen\Environment;
use Adyen\Model\Checkout\Amount;
use Adyen\Model\Checkout\CreateCheckoutSessionRequest;
use Adyen\Service\Checkout\PaymentsApi;

define('ADYEN_API_KEY', 'AQEshmfxLovKYxxKw0m/n3Q5qf3Vf45PHZZOUWFZ1S9jmI2g6AjLVPhFRfUP90sQwV1bDb7kfNy1WIxIIkxgBw==-Sb7HfWOzY9yJUmG0PXGkwpsq3WOmx17PvaaDgwFtf9A=-i1iW4M3GwfE.JEHV,_2');
define('ADYEN_MERCHANT', 'Webpedidos');
define('ADYEN_CLIENT_KEY', 'test_ZDVCTMMUIFEZTBLBKTOSOZMRIUIMJCPM');
define('ADYEN_ENV', 'TEST');

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
  ->setMerchantAccount(ADYEN_MERCHANT)
  ->setCountryCode("NL")
  ->setReturnUrl("http://localhost/WebPedidos/resultado.php");

$requestOptions['idempotencyKey'] = 'UUID';

// Llamada a la API de Adyen
$service = new PaymentsApi($client);
try {
    $response = $service->sessions($createCheckoutSessionRequest, $requestOptions);

    // Depuración: mostrar la respuesta de la API
    echo '<pre>';
    print_r($response); // Esto te ayudará a ver si realmente hay una respuesta válida.
    echo '</pre>';

    // Guardar la respuesta en la sesión
    //$_SESSION['adyen_response'] = $response;

} catch (Exception $e) {
    // Captura cualquier error y muestra el mensaje
    echo "Error: " . $e->getMessage() . "<br>";
    echo "Detalles del error: " . $e->getTraceAsString();  // Mostrar traza para depuración adicional.
}

?>
