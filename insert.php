<?php
// header('Content-Type: application/json');
//Sanitize against XSS
// $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);




$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if( !empty( $_POST ) ){
    $postArray = array(
      "name" => $_POST['name'],
      "school" => $_POST['school'],
      "year" => $_POST['year'],
      "sport" => $_POST['sport'],
      "position" => $_POST['position'],
      "chip" => $_POST['chip'],
      "url" => $_FILES["fileToUpload"]["name"],
      "credit" => $_POST['credit'],
    );

	$file = file_get_contents('entries.json');

	if (!empty($file)){
		$decode = json_decode($file, true);
		array_push( $decode, $postArray);
		$json = json_encode ($decode);
		file_put_contents('entries.json', $json);
	} else {
		$array = array($postArray);
		$encode = json_encode($array);
		file_put_contents('entries.json', $encode);	
	}

	$page = "admin.php";
	header("Location: " . $page); 

// echo $json;
} 

// print_r($_POST)


// $target_path = "uploads/";

// $target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

// if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
//     echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
//     " has been uploaded";
// } else{
//     echo "There was an error uploading the file, please try again!";
// }

// $data = array();

// if(isset($_GET['files']))
// {  
//     $error = false;
//     $files = array();

//     $uploaddir = './uploads/';
//     foreach($_FILES as $file)
//     {
//         if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
//         {
//             $files[] = $uploaddir .$file['name'];
//         }
//         else
//         {
//             $error = true;
//         }
//     }
//     $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
// }
// else
// {
//     $data = array('success' => 'Form was submitted', 'formData' => $_POST);
// }

// echo json_encode($data);

?>