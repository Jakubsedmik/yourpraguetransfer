<?php

/**
 * This is a simple script showing your IP address
 */

header("Content-Type: text/plain; charset=UTF-8");

$c = curl_init();
curl_setopt($c, CURLOPT_URL, 'http://payments.agmo.eu/merchant/ip');
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
$ip_address = curl_exec($c);
curl_close($c);

echo 'Your IP address is: '.$ip_address;