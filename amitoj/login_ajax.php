<?php
	require_once 'functions.php';
	connect_db();//connected to database amidb

	session_start();

	if(login_check($_POST)){
			$_SESSION['username'] = $_POST['username'];
			echo json_encode(true);
		}
		else{
			echo json_encode(false);
	}
?>