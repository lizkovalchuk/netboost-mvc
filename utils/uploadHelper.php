<?php
Class UploadHelper{
	public static function uploadFile($formName,&$message){
		$target_dir = "../web/uploads/articles/";
		//var_dump(scandir('../web/uploads'));
		$filename = basename($_FILES[$formName]["name"]);
		$target_file =  $target_dir . $filename;
		// echo $target_file;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST)&&$_FILES[$formName]["tmp_name"]!="") {
		    $check = getimagesize($_FILES[$formName]["tmp_name"]);
		    if($check !== false) {
		        //echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        $message = "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    $message =  "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES[$formName]["size"] > 1000000) {
		    $message =  "Sorry, your file is too large.";
		    $uploadOk = 0;
		    echo "3";
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
		    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    return false;
		    $message =  "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES[$formName]["tmp_name"], $target_file)) {
		        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		        $message = null;
		        return $filename;
		    } else {
		        $message =  "Sorry, there was an error uploading your file.";
		        return false;
		    }
		}

	}
}