<?php 

//enabling error reprting
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	require_once 'functions.php'; 
	connect_db();

	$query = "select password from reg_users where id=".$_GET['user_id'];

	$result = $conn->query($query);

	if ($result->num_rows > 0) {
	   $database_pass = $result->fetch_assoc()['password']; //converting result in array and extracting password
	}
	else{
		echo "password not fetched";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="POST">
		enter your password <input type="password" name="password">
		<input type="submit" name="submit">
	</form>
	<?php
		if (isset($_POST['submit'])){

			$password = md5($_POST['password']);
			
			if ($password == $database_pass){

				echo "<br> passwords match";

				$delete = "delete from reg_users where id=".$_GET['user_id'];

				if ($conn->query($delete) === TRUE){
					echo "<br> record deleted successfully";
					header('Location: retrieve_data.php');
				}
				else{
					echo "Error deleting the record: ". $conn->error;
				}
			}
			else{
				echo "enter correct password";
			}
		}
	?>
</body>
</html>