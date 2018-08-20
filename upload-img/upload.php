<?php
	$target_dir = "../img-uploaded/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        echo "Error. File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Error. File already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
	    echo "Error. File is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	    echo "Error. Only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Error. File was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		$temp = explode(".", $_FILES["fileToUpload"]["name"]);
		$newfilename = uniqid() . '.' . end($temp);
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
	        session_start();
	        // $_SESSION["upload"] = $newfilename;
			$host = $_SERVER["HTTP_HOST"];
			header("Location: http://$host/?upload=".$newfilename);
	    } else {
	        echo "Error. File could not be uploaded.";
	    }
	}
?>