<?php
	header('Content-Type: application/json');
	// $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	if( !empty( $_POST ) ){
	echo $_POST['data'][0];
	file_put_contents('entries.json', $_POST['data']);
	
    } 
	
?>