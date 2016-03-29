<pre><?php

//print_r($_SERVER); exit();

//echo 123;
$source = "http://www.mailbeez.com/wp-content/uploads/downloads/2015/04/mailbeez_v2.9.910.zip";

$source = "http://www.mailbeez.com/wp-content/uploads/downloads/2010/05/birthday_v1.0.zip";



$url = $source;

$fp = fopen($url, 'r');

$meta_data = stream_get_meta_data($fp);

print_r($meta_data);
exit();


//$source = "http://www.mailbeez.com/wp-content/uploads/2014/06/logo.png";


//download_remote_file_with_fopen($source, 'test2.zip');
/*

$content = file_get_contents($source);
file_put_contents('test1.zip', $content);

echo "done";

exit();

*/

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


/*

	function download_remote_file_with_fopen($file_url, $save_to)
	{
		$in=    fopen($file_url, "rb");
		$out=   fopen($save_to, "wb");
 
		while ($chunk = fread($in,8192))
		{
			fwrite($out, $chunk, 8192);
		}
 
		fclose($in);
		fclose($out);
	}

*/