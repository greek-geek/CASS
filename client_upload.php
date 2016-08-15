<?php

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

	if(isset($_POST['submit']))
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
		<title>Upload</title>
	</head>
	<body>		
		<form action="#" method="post" enctype="multipart/form-data">
			Select a file to upload on the server: &nbsp; &nbsp;<input type="file" name="file" id="file"> <br><br>
			Enter the secret key: <input type="text" name="key" > <br><br>
			<input type="submit" name="submit" value="Upload"> &nbsp; &nbsp;
			<input type="reset" name="reset" value="Reset">		
		</form>
		
	</body>
</html>