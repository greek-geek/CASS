<html>
	<head>
		<title>Download</title>
	</head>
	<body>		
		<form action="server.php" method="post" enctype="multipart/form-data">
			Select a file to download from the server: &nbsp; &nbsp;<input type="file" name="file" id="file"> <br><br>
			Enter the secret key: <input type="text" name="key" > <br><br>
			<input type="submit" name="submit_download" value="Download"> &nbsp; &nbsp;
			<input type="reset" name="reset" value="Reset">		
		</form>
	</body>
</html>