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

	 if(isset($_POST['submit_download']))
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
			fclose($handle);
			echo '<a href="/CASS/'.$filename.'" download> Click Here to download the file </a><br>';
			echo "<hr>";
			echo "<br><br>";
			//echo '<a href="index.html" onclick="'.unlink($filename).'" >Go Back to the Index.html page</a><br>';
					  
			//unlink($filename);
		
		}
	}
	
	function Encrypt($data, $secret)
	{    
	  //Generate a key from a hash
	  $key = md5(utf8_encode($secret), true);

	  //Take first 8 bytes of $key and append them to the end of $key.
	  $key .= substr($key, 0, 8);

	  //Pad for PKCS7
	  $blockSize = mcrypt_get_block_size('tripledes', 'ecb');
	  $len = strlen($data);
	  $pad = $blockSize - ($len % $blockSize);
	  $data .= str_repeat(chr($pad), $pad);

	  //Encrypt data
	  $encData = mcrypt_encrypt('tripledes', $key, $data, 'ecb');

	  return base64_encode($encData);
	}

	if(isset($_POST['submit_upload']))
	{
		$key = $_POST['key'];
		if($_FILES["file"]["error"] > 0)
			echo "Error in uploading file: ".$_FILES["file"]["error"]."<br>";
		else
		{
			$filename = $_FILES["file"]["name"];
			$handle = fopen($filename, "r");
			$content = fread($handle, filesize($filename));
			$EncryptedData=Encrypt($content, $key);
			
			echo "Encrypting and Uploading the File..."."<br>";
			
			move_uploaded_file($_FILES["file"]["tmp_name"], "ServerFiles/".$_FILES["file"]["name"]);
			$filename = "ServerFiles/".$_FILES["file"]["name"];
			$handle = fopen($filename, "w");
			fwrite($handle, $EncryptedData);
			
			echo "File Uploaded!!"."<br>";
			echo "<hr>";
			
		}
	}	

?>

<html>
	<head>
		<title>Server</title>
	</head>
	<body>				
	</body>
</html>