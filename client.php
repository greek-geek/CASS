<?php

if($_FILES)
{
	$filename=$_FILES['input']['name'];
	echo  "File_name :". $filename;
/*
	echo "</br>";
	
	$temppath=$_FILES["input"]["tmp_name"];
	echo "\nFile Stored At :".$_FILES["input"]["tmp_name"];

	$tempfilename=basename($temppath);
	echo "</br>";

	//$path= getcwd();
	//echo "<br>";
	//echo $path;
	//echo realpath($filename);*/
}	
	$newfilename="newfile.txt";
	$salt="abcd";
	$myfile = fopen($filename,"r") or die("Unable to open file!");
	$enc_file=fopen($newfilename,"w") or die("Unable to open file!");
	// Output one line until end-of-file
	echo "</br>";
	while(!feof($myfile))
		{
			
			
			$cipher=MCRYPT_DES;
			$key="abcdefgh";
			$data=fgets($myfile);
			$mode='ecb';
			echo $data."</br>";
			$encrypted=mcrypt_encrypt($cipher,$key,$data,$mode);
			fwrite($enc_file,$encrypted);
			echo $encrypted . "<br>";
		}
	fclose($myfile);
	fclose($enc_file);

			rename($newfilename,$_FILES["input"]["tmp_name"]);
			move_uploaded_file($_FILES["input"]["tmp_name"],"Uploads/".$_FILES["input"]["name"]);
			echo "File Uploaded Sucessfully to your Server";
		
?> 