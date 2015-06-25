<?php
	header('Content-Type: application/json');
	// $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	if( !empty( $_POST ) ){
    // $postArray = array(
    //   "name" => $_POST['name'],
    //   "email" => $_POST['email'],
    //   "description" => $_POST['description'],
    //   "lat" => $_POST['lat'],
    //   "lng" => $_POST['lng'],
    // );
    // $file = file_get_contents('entries.json');
	// $encode = json_encode($_POST);
	echo $_POST['data'][0];
	file_put_contents('entries.json', $_POST['data']);
	
    } 
	
?>