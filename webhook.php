<?php

$data = file_get_contents("php://input");

// Guardar log para ver que llega
file_put_contents("adyen_webhook.log", $data.PHP_EOL, FILE_APPEND);

// Aquí luego procesarías el JSON
http_response_code(200);

?>