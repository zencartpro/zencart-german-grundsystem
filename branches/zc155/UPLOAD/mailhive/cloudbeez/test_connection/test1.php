<pre><?php

//print_r($_SERVER); exit();

//echo 123;
$source = "http://www.mailbeez.com/wp-content/uploads/downloads/2015/04/mailbeez_v2.9.910.zip";

$source = "http://www.mailbeez.com/wp-content/uploads/downloads/2010/05/birthday_v1.0.zip";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $source);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSLVERSION,3);


$stream = fopen('test.zip', 'w');

curl_setopt($ch, CURLOPT_FILE, $stream);

$data = curl_exec ($ch);
$error = curl_error($ch); 

print_r (curl_getinfo($ch));  

print_r($error);

curl_close ($ch);


