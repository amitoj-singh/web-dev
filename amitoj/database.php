<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php

	//enabling error reprting
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	
	include 'functions.php'; //connected to database amidb
	connect_db();

	


	/*$sql = "Create Table if not exists reg_users (
			id int(12) primary key,
			name varchar(30) not null,
			gender varchar(10),
			fathers_name varchar(30),
			username varchar(16), 
			password varchar(12) not null,
			number int(10) not null,
			email varchar(36) not null,
			state varchar(20),
			city varchar(20),
			address varchar(50),
			pincode int(10),
			dob date,
			course varchar(30))";

	if ($conn->query($sql) === TRUE){
		echo "Table reg_users created successfully";
	}
	else{
		echo "Error creating table: ". $conn->error;
	}
	*/
	//$id = 1;

	/*$sql = "Alter table reg_users add hobbies varchar(255)";
	if ($conn->query($sql) === TRUE){
		echo "success";
	}
	die;*/

if ( isset($_POST['submit']) ){

	echo $name = $_POST["name"];
	//$name = validation($name, "name");
	echo "<br>";
	echo $gender = isset($_POST["gender"])?$_POST["gender"]:'';
	//$gender = validation($gender, "Gender");
	echo "<br>";
	echo $fathers_name = $_POST["father_name"];
	//$fathers_name = validation($fathers_name, "Father's Name");
	echo "<br>";
	echo $username = $_POST["username"];
	//$username = validation($username, "username");
	echo "<br>";
	echo $password = $_POST["password"];
	//$password = validation($password, "password");
	echo "<br>";
	echo $confirm_password = $_POST["confirm_password"];
	//$confirm_password = Validation($confirm_password, "Confirm Password");
	echo "<br>";
	echo $number = $_POST["mobile_number"];
	//$number = Validation($number, "Mobile Number");
	echo "<br>";
	echo $email = $_POST["email"];
	//$email = Validation($email, "Email ID");
	echo "<br>";
	echo $state = $_POST["state"];
	//$state = Validation($state, "State");
	echo "<br>";
	echo $city = $_POST["city"];
	//$city = Validation($city, "city");
	echo "<br>";
	echo $address = $_POST["address"];
	//$address = validation($address, "Address");
	echo "<br>";
	echo $pincode = $_POST["pincode"];
	//$pincode = Validation($pincode, "Pincode");
	echo "<br>";
	echo $dob = $_POST["dob"];
	//$dob = Validation($dob, "DOB");
	echo "<br>";
	echo $course = $_POST["course"];
	//$course = validation($course, "Course");
	echo "<br>";
	$arr = isset($_POST['hobby'])?$_POST['hobby']:'';
	echo $hobbies = implode(", ", $arr);
	//$hobbies = validation($hobbies, "Hobbies");
	echo "<br>";

	$data = array("name"=>$name, "gender"=>$gender, "username"=>$username, "password"=>$password, "confirm password"=>$confirm_password, "number"=>$number, "email"=>$email, "hobbies"=>$hobbies);
	//checking the required fields if they remain unfilled by the user
	$error = ""; //marking empty to check during inserting data whether errors occured or not
	$error = validation($data);
	// displaying empty fields in the
	for ($i=0; $i <count($error) ; $i++) {
		echo $error[$i];
	}

	echo "<br>";
	
	//checking if password and confirm password entries match
	//if the passwords match then the password is encrypted (using md5)
	if($password === $confirm_password){

		$password = md5($_POST["password"]);		
	}
	else{
		echo "<br>passwords do not match";
		exit;
	}

	$date=date_create();	
	$file_name = $_FILES['profile_pic']['name'];
	$file_data = explode('.', $file_name);
	$ext = end($file_data); 
	echo $new_file_name = $name."_".date_timestamp_get($date).'.'.$ext;
	
	$destination = "uploads/".$new_file_name;
	
	// $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
	// echo "<br>".$file_ext;

	$req_ext = array("jpg", "png", "jpeg");

	if ( file_exists($_FILES['profile_pic']['tmp_name'])){
		if ( in_array($ext, $req_ext) ){
			if (move_uploaded_file($_FILES['profile_pic']['tmp_name'],$destination) == TRUE){
				echo "<br>image uploading success";
			}
			else{
				echo "<br>error uploading image";
			}
		}
		else{
			echo "<br> upload image file only";
		}
	}
	else {
		echo "<br> upload file";
	}

	//filter_var(variable)

	/*$sql = "Alter table reg_users modify number bigint";
	if ($conn->query($sql) === TRUE){
		echo "<br>Table successfully updated";
	}
	else{
		echo "Error updating table: ". $conn->error; 
	}*/	

	if(empty($error)){
		$arr = array("name"=>"'$name'", "gender"=>"'$gender'", "fathers_name"=>"'$fathers_name'", "email" => "'$email'", "profile_pic" => "'$new_file_name'" );

		insert("reg_users", $arr);
	}
} // isset ends
		

		/************Inserting data in database directly using query*/
		// $sql = "Insert into reg_users (name, gender, fathers_name, username, password, number, email, state, city, address, pincode, dob, course, profile_pic, hobbies) Values('$name', '$gender', '$fathers_name', '$username', '$password', '$number', '$email', '$state', '$city', '$address', '$pincode', '$dob', '$course', '$new_file_name', '$hobbies')";

	

		// if ($conn->query($sql) === TRUE){
		// 	echo "Data inserted";
		// }

		// else{
		// 	echo "Error inserting data: " . $conn->error;
		// }

?>
</body>
</html>