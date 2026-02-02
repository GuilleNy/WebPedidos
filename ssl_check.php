<?php
echo "<pre>";
print_r(openssl_get_cert_locations());

$ch = curl_init("https://checkout-test.adyen.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);

if ($result === false) {
    echo curl_error($ch);
} else {
    echo "SSL OK";
}



?>