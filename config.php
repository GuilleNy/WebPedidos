<?php
require __DIR__ . '/vendor/autoload.php'; // carga la librería de Adyen

use Adyen\Client;

$client = new Client();
$client->setXApiKey("AQEshmfxLYrIbhJLw0m/n3Q5qf3Vf45PHZZOUWFZ1YdU/Vpvhcjfo6JPcKGuP8IQwV1bDb7kfNy1WIxIIkxgBw==-wNNg3lTre0hd+x4CrKMEjyjgw3ipz2EzEwQL1vQb7A4=-i1i2]62sI,JY.Q>Kbbm"); // tu API Key de test
$client->setEnvironment("TEST"); // modo prueba
?>

