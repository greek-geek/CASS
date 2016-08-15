 <?php

if($_FILES)
{
	$filename=$_FILES['input']['name'];
	echo  "File_name :".$filename;
}

	$newfilename="downloadnewfile.txt";
	$salt="abcd";
	$myfile = fopen($filename,"r") or die("Unable to open file!");
	$enc_file=fopen($newfilename,"w") or die("Unable to open file!");

	echo "</br>";
	while(!feof($myfile))
		{
			
			
			$cipher=MCRYPT_DES;
			$key="abcdefgh";
			$data=fgets($myfile);
			$mode='ecb';
			echo $data."</br>";
			$encrypted=mcrypt_decrypt($cipher,$key,$data,$mode);
			fwrite($enc_file,$encrypted);
			echo $encrypted . "<br>";
		}
	fclose($myfile);
	fclose($enc_file);

			rename($newfilename,$_FILES["input"]["tmp_name"]);
			move_uploaded_file($_FILES["input"]["tmp_name"],"../Downloads/".$_FILES["input"]["name"]);
			echo "File Sucessfully downloaded to clients folder";
?> 