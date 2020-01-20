<h1>MailBeez CloudLoader Connection Speed Test</h1>
<?php
$source = "http://cloudbeez.com/speedtest_file.zip";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $source);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSLVERSION, 3);

//$stream = fopen('test.zip', 'w');
//curl_setopt($ch, CURLOPT_FILE, $stream);

$data = curl_exec($ch);
$error = curl_error($ch);
$info = curl_getinfo($ch);
curl_close($ch);

?>
<?php

if ($info['speed_download'] < 333000) {
    echo '<b><font color="red">Speed_download too slow (' . $info['speed_download'] . ' Bytes per Second), please contact your Server Admin with reference to this page.</b>';
} else {
    echo 'OK (' . $info['speed_download'] . ' Bytes per Second)';
}

?>
<pre>
<?php
print_r($info);
?>
</pre>