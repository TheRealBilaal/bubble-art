<!DOCTYPE html>
<html>
	<head>
	    <meta charset='utf-8'>
	    <title>Bubble Art</title>
	    <link rel="stylesheet" type="text/css" href="/main.css">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<?php include "../header.php"; ?>
		<section>
			<h1>Upload Image</h1>
			<form action="upload.php" method="post" enctype="multipart/form-data">
			    <input type="file" name="fileToUpload" id="fileToUpload">
			    <input type="submit" value="Upload Image" name="submit">
			</form>
		</section>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="/nav.js"></script>
	</body>
</html>