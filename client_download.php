<?php

	function Decrypt($data, $secret)
	{
		//Generate a key from a hash
		$key = md5(utf8_encode($secret), true);

		//Take first 8 bytes of $key and append them to the end of $key.
		$key .= substr($key, 0, 8);

		$data = base64_decode($data);

		$data = mcrypt_decrypt('tripledes', $key, $data, 'ecb');

		$block = mcrypt_get_block_size('tripledes', 'ecb');
		$len = strlen($data);
		$pad = ord($data[$len-1]);

		return substr($data, 0, strlen($data) - $pad);
	}

	//echo Decrypt("FGk7LV7ggRNRUK8JW1RejRCN22O2cGFLa9gUb1ZR8uY96RI/tJIelloOrmb5j4CFhM/yeq3Z6Ub3JfPvYaFslvhCRWGBf6VTMUFAvX/New1WNQWj6/EzbSUXVTLca6ogYbdr2n2oAAU=", 1234);
	if(isset($_POST['submit']))
	{
		$key = $_POST['key'];
		if($_FILES["file"]["error"] > 0)
			echo "Error: ".$_FILES["file"]["error"]."<br>";
		else
		{
			move_uploaded_file($_FILES["file"]["tmp_name"], "Temp/".$_FILES["file"]["name"]);
	
			$filename = "Temp/".$_FILES["file"]["name"];
			$handle = fopen($filename, "r");
			//echo filesize($filename);
			$content = fread($handle, filesize($filename));
			
			$DecryptedData=Decrypt($content, $key);
			
			$handle = fopen($filename, "w");
			fwrite($handle, $DecryptedData);
			
			echo '<a href="/CASS/'.$filename.'" download> Click Here to download the file </a><br>';
			echo "<hr>";
			fclose($handle);
			unlink($filename);
		}
	}
	

?>

<html>
	<head>
		<title>Download</title>
	</head>
	<body>		
		<form action="#" method="post" enctype="multipart/form-data">
			Select a file to download from the server: &nbsp; &nbsp;<input type="file" name="file" id="file"> <br><br>
			Enter the secret key: <input type="text" name="key" > <br><br>
			<input type="submit" name="submit" value="Download"> &nbsp; &nbsp;
			<input type="reset" name="reset" value="Reset">		
		</form>
	</body>
</html>