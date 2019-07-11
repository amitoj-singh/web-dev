<?php
	require_once 'functions.php'; 
	connect_db();//connected to database amidb
	global $conn;

	session_start();
	if(empty($_SESSION)) {
   		header('Location: login.php');
	}

	if (isset($_POST['submit']))
	{
		$query = "select password from reg_users where username='".$_SESSION['username']."'";
		
		$result = $conn->query($query);

		if ($result->num_rows > 0) {
		   $database_pass = $result->fetch_assoc()['password']; //converting result in array and extracting password
		}
		else{
			echo "password not fetched";
		}

		if ($database_pass == md5($_POST['current_password'])) {
			if (strlen($_POST['new_password']) >= 8){
				if ($_POST['new_password'] == $_POST['re_password']){
					$password = md5($_POST['new_password']);
					$query = "update reg_users set password = '$password' where username='".$_SESSION['username']."'";
					if ( $conn->query($query) === TRUE ){
						session_unset();
						session_destroy();
						$result1 = array("status"=>"success","data"=>"passwords updated successfully");
						echo json_encode($result1);
					}
				}
				else{
					$result1 = array("status"=>"error","data"=>"passwords do not match");
					echo json_encode($result1);	
				}
			}			
			else{
				$result1 = array("status"=>"error","data"=>"minimum length should be 8 characters");
				echo json_encode($result1);
			}
		}
		else {
			$result1 = array("status"=>"error","data"=>"current password incorrect");
			echo json_encode($result1);	
		}
	}
?>