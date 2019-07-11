<?php
	global $conn;

	//enabling error reprting
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

function connect_db(){
	global $conn;
	define("HOST", "localhost");
	define("USERNAME", "root");
	define("PASS", "quintsoft");
	define("DBNAME", "AmiDB");

	$conn = new mysqli(HOST, USERNAME, PASS, DBNAME);

	if ($conn->connect_error){
		die('Connection Error');
	}
}

//Function to create a new table in the database
function create_table ($sql){
	global $conn;
	if ($conn->query($sql) === TRUE){
		echo "<br>Table created successfully";
	}	
	else{
		echo "<br>Error creating table: ". $conn->error;
	}
}

//Function to insert form data in the database
/*
	* Takes name of the table in which data is to be inserted
	* Takes an associative array paasing keys as column names and values as the associated values entered by users
*/
function insert ($usrData){
	global $conn;
	// $arr_key = array_keys($arr);	
	// $columns = implode(", ", $arr_key);
	// $values = implode(", ", $arr);
	
	// echo $sql = "insert into ". $table_name. ' ('. $columns. ') values ('. $values. ')'; // displaying final sql query string
	
	$count = 0;
	$fields = '';


	foreach($usrData as $col => $val) {

		if ($count++ != 0) $fields .= ', ';

		$col = mysql_real_escape_string($col);
		$val = mysql_real_escape_string($val);
		$fields .= "`$col` = $val";
	}

	$query = "INSERT INTO `reg_users` SET $fields";

	if ($conn->query($query) === TRUE){
		echo "<br>Data inserted";
	}
	else{
		echo "<br>Error inserting data: " . $conn->error;
	}

}

//Validating if any data field is left empty
function validation ($data){

	$error = array(); // array to store empty fields
	foreach ($data as $key => $value) {

		$value = trim($value); //removes any extra white space

		if (empty($value)){ //checks if no value is given by the user
			$error[] = "Enter ". $key. "<br>";
		}
	}
	return $error;
}

//Function to upload image file for profile pic, this function also validates the file uploaded and returns a flag which is used display error 
function imgUpload (){

	$date=date_create();
	$file_name = $_FILES['profile_pic']['name'];
	$file_data = explode('.', $file_name);
	$ext = end($file_data);
	$new_file_name = $_POST['name']."_".date_timestamp_get($date).'.'.$ext;

	$destination = "uploads/".$new_file_name;

	$flag = 0;
	echo "<pre>";
	print_r($_FILES);
	$req_ext = array("jpg", "png", "jpeg");

	if ( file_exists($_FILES['profile_pic']['tmp_name'])){		
		if ( in_array($ext, $req_ext) ){
			move_uploaded_file($_FILES['profile_pic']['tmp_name'],$destination);
			return array("flag"=>$flag, "new_file_name"=>$new_file_name);
		}
		else{
			$flag = 2; // incorrect file type
			return array("flag"=>$flag, "new_file_name"=>"");
		}
	}
	else {			
		$flag = 1; // file not uploaded
		return array("flag"=>$flag, "new_file_name"=>"");
	}	
}

//function to validate each field of the form
/*
	--It takes $_POST array from HTML form and check each key whether its value
	  exists or not and if it exists then is it a valid or invalid value
*/
function submit_form($form_data){
	$response=array();
	$error_messages=array();

	if(empty(trim($form_data['name']))){
		$error_messages['name']='Name is required';
	}

	if(empty(trim($form_data['gender']))){
		$error_messages['gender']='gender is required';	
	}

	// if(empty(trim($form_data['father_name']))){
	// 	$error_messages['father_name']="Father's name is required";
	// }

	if(empty(trim($form_data['username']))){
		$error_messages['username']='username is required';
	}
	elseif (is_username_exist($form_data['username'])) {
		$error_messages['username']='username already exists';
	}

	if( isset($form_data['password']) && empty(trim($form_data['password']))){
		$error_messages['password']='password is required';
	}
	if( isset ($form_data['confirm_password'])){
		if(empty(trim($form_data['confirm_password']))){
			$error_messages['confirm_password']='confirm password is required';
		}
		else{
			if ($form_data['password'] == $form_data['confirm_password']){
				$form_data['password'] = md5($form_data['password']);
			}
			else{
				$error_messages['confirm_password']='password and confirm password needs to be same';
			}
		}
	}	

	if(empty(trim($form_data['mobile_number']))){
		$error_messages['mobile_number']='mobile number is required';
	}
		else{
			if ( !preg_match('/^[0-9]{10}+$/', $form_data['mobile_number']) ){
				$error_messages['mobile_number']='invalid mobile number';
			}
		}

	if(empty(trim($form_data['email']))){
		$error_messages['email']='email is required';
	}
	elseif (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
		$error_messages['email']='invalid email address';
	}
	elseif(is_email_exist($form_data['email'])){
		$error_messages['email']='Email already exist';
	}

	if(empty(trim($form_data['state']))){
		$error_messages['state']='state is required';
	}

	if(empty(trim($form_data['city']))){
		$error_messages['city']='city is required';
	}

	if(empty(trim($form_data['address']))){
		$error_messages['address']='address is required';
	}

	// if(empty(trim($form_data['pincode']))){
	// 	$error_messages['pincode']='pincode is required';
	// }
	// else{
	// 		if ( !preg_match('/^[0-9]{6}+$/', $form_data['pincode']) ){
	// 			$error_messages['pincode']='invalid pincode';
	// 		}
	// 	}

	// if(empty(trim($form_data['dob']))){
	// 	$error_messages['dob']='DOB is required';
	// }

	if(empty(trim($form_data['course']))){
		$error_messages['course']='course is required';
	}

	if(empty($form_data['hobby'])){
		$error_messages['hobby']='hobbies are required';
	}

	$flag = imgUpload();
	if ($flag['flag'] == 1){
		$error_messages['profile_pic']='Upload profile picture';
	}
	elseif ($flag['flag'] == 2) {
		$error_messages['profile_pic']='upload jpg, png or jpeg file only';
	}
	else{
		$response['profile_pic']=$flag['new_file_name'];
	}

	if(empty($error_messages)){
		$response['status']='success';
		$response['message']='Form Submitted successfully';
	} else {
		$response['status']='error';
		$response['message']=$error_messages;
	}

	return $response; // returns the error messages or the success message
}



//Function to check if email already exisis in the database
function is_email_exist($email){
	global $conn;

	$sql = "Select email from reg_users";
	$result = $conn->query($sql);	
	if ($result->num_rows > 0){
		while ($db_emails = $result->fetch_assoc()){
		
			if ($db_emails['email'] == $email){
				return TRUE;
			}
		}
	}
	return FALSE;
}

function is_username_exist($username){
	global $conn;

	$sql = "select username from reg_users";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while ($db_username = $result->fetch_assoc()){
			if ($db_username['username'] == $username){
				return TRUE;
			}
		}
	}
	return FALSE;
}

function login_check($login_data){
	global $conn;
	
	$sql = "select username, password from reg_users";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while($db_data = $result->fetch_assoc()){
			if ($db_data['username'] == $login_data['username'] && $db_data['password'] == md5($login_data['password'])) {
				return TRUE;
			}
		}
	}
	return FALSE;
}

function import_validation($import_data){
	$response = array();
	$error_messages = array();

	if(empty(trim($import_data['name']))){
		$error_messages['name']='Name is required';
	}

	if(empty(trim($import_data['gender']))){
		$error_messages['gender']='gender is required';	
	}
	
	if(empty(trim($import_data['username']))){
		$error_messages['username']='username is required';
	}
	elseif (is_username_exist($import_data['username'])) {
		$error_messages['username']='username already exists';
	}

	if( isset($import_data['password']) && empty(trim($import_data['password']))){
		$error_messages['password']='password is required';
	}
	// if( isset ($import_data['confirm_password'])){
	// 	if(empty(trim($import_data['confirm_password']))){
	// 		$error_messages['confirm_password']='confirm password is required';
	// 	}
	// 	else{
	// 		if ($import_data['password'] == $import_data['confirm_password']){
	// 			$import_data['password'] = md5($import_data['password']);
	// 		}
	// 		else{
	// 			$error_messages['confirm_password']='password and confirm password needs to be same';
	// 		}
	// 	}
	// }

	if(empty(trim($import_data['mobile_number']))){
		$error_messages['mobile_number']='mobile number is required';
	}
	elseif ( !preg_match('/^[0-9]{10}+$/', $import_data['mobile_number']) ){
			$error_messages['mobile_number']='invalid mobile number';
	}

	if(empty(trim($import_data['email']))){
		$error_messages['email']='email is required';
	}
	elseif (!filter_var($import_data['email'], FILTER_VALIDATE_EMAIL)) {
		$error_messages['email']='invalid email address';
	}
	elseif(is_email_exist($import_data['email'])){
		$error_messages['email']='Email already exist';
	}

	if(empty(trim($import_data['state']))){
		$error_messages['state']='state is required';
	}

	if(empty(trim($import_data['city']))){
		$error_messages['city']='city is required';
	}

	if(empty(trim($import_data['address']))){
		$error_messages['address']='address is required';
	}

	if(empty(trim($import_data['course']))){
		$error_messages['course']='course is required';
	}

	if(empty(trim($import_data['profile_pic']))){
		$error_messages['profile_pic']='profile pic is required';
		$response['profile_pic'] = "";
	}
	else{
		$file_name = $import_data['profile_pic'];
		$date=date_create();
		$file_ext = explode('.', $file_name);
		$ext = end($file_ext);
		$req_ext = array("jpg", "png", "jpeg");
		if ( in_array($ext, $req_ext) ){
			$profile_pic = $import_data['name']."_".date_timestamp_get($date).'.'.$ext;
			$destination = "uploads/".$profile_pic;
			$file_data = file_get_contents($file_name);
			$new_profile_pic = file_put_contents($destination, $file_data);
			$response['profile_pic'] = $profile_pic;
		}
		else{
			$error_messages['profile_pic']='profile pic should be jpg, jpeg or png file';
			$response['profile_pic'] = "";
		}
	}
	

	if(empty($import_data['hobby'])){
		$error_messages['hobby']='hobbies are required';
	}

	if(empty($import_data['hobby'])){
		$error_messages['hobby']='hobbies are required';
	}

	if(empty($error_messages)){
		$response['status']='success';
		$response['message']='Form Submitted successfully';
	} else {
		$response['status']='error';
		$response['message']=$error_messages;
	}

	return $response; // returns the error messages or the success message
}