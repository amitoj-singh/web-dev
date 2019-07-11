<?php 

//enabling error reprting
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require_once 'functions.php'; 

	connect_db();//connected to database amidb
	
	if ( isset($_POST['submit']) ){
		$data = submit_form($_POST);	
	}
?>

<!DOCTYPE html>
	<html lang="en-us">
	<head>
		<title>registration form</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>

		<header>
			<h1>Basic Registeration form HTML and CSS</h1>
		</header>

		<?php 
		// if(isset($data) && $data['status']=='error'){
		// 	foreach ($data['message'] as $key => $value) {
		// 		echo '<p class="error">'.$value.'</p>';
		// 	}
		// } else

		if(isset($data) && $data['status']=='success') {
			echo '<p class="error">'.$data['message'] .'</p>';
			//insert($_POST);
			// $sql = "Insert into reg_users (name, gender, father_name, username, password, number, email, state, city, address, pincode, dob, course, profile_pic, hobby) Values("$_POST['name']", '$gender', '$fathers_name', '$username', '$password', '$number', '$email', '$state', '$city', '$address', '$pincode', '$dob', '$course', '$new_file_name', '$hobbies')";

			$name = $_POST['name'];
			$gender = $_POST['gender'];
			$profile_pic = imgUpload();
			$profile_pic = $profile_pic['new_file_name'];
			$father_name = $_POST["father_name"];
			$username = $_POST["username"];
			$password = md5($_POST["password"]);
			$mobile_number = $_POST["mobile_number"];
			$email = $_POST['email'];
			$state = $_POST['state'];
			$city = $_POST['city'];
			$address = $_POST['address'];
			$pincode = $_POST['pincode'];
			$dob = $_POST['dob'];
			$course = $_POST['course'];
			$arr = isset($_POST['hobby'])?$_POST['hobby']:'';
			$hobby = implode(", ", $arr);

			require 'PHPMailer/src/Exception.php';
			require 'PHPMailer/src/PHPMailer.php';
			require 'PHPMailer/src/SMTP.php';

			$mail = new PHPMailer(true);

			$mail->SMTPDebug = 2;                                       // Enable verbose debug output
		    $mail->isSMTP();                                            // Set mailer to use SMTP
		    $mail->Host       = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
		    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    $mail->Username   = 'houky9@gmail.com';                     // SMTP username
		    $mail->Password   = 'facebook001';                               // SMTP password
		    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
		    $mail->Port       = 587;                                    // TCP port to connect to

		    $mail->setFrom('houky9@gmail.com', 'Amitoj');
		    $mail->addAddress($email, $name); 

		    $mail->Subject = 'registeration successful';
		    $mail->Body    = 'Hello, thank you for registering with quintsoft';
		    $mail->send();

			$sql = "insert into reg_users (name, gender, profile_pic, father_name, username, password, mobile_number, email, state, city, address, pincode, dob, course, hobby) values ('$name', '$gender', '$profile_pic', '$father_name', '$username', '$password', '$mobile_number', '$email', '$state', '$city', '$address', '$pincode', '$dob', '$course', '$hobby')";

			if ($conn->query($sql) === TRUE){
				echo "<br>Data inserted";
			}
			else{
				echo "<br>Error inserting data: " . $conn->error;
			}

			header ('Location: success.php');
		}
		?>

		<div id="container">
			<form action="" method="post" id="form1" enctype="multipart/form-data">

				<div class="form-input">
					<input class="inp" type="text" name="name" placeholder="Name*"> 
					<?php if(isset($data['message']['name']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['name'].'</p>';}?>
				</div>

				<div class="form-input cstm">
					<input type="radio" name="gender" value="Male" checked> Male
					<input type="radio" name="gender" value="Female"> Female
					<input type="radio" name="gender" value="other"> other
					<?php if(isset($data['message']['gender']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['gender'].'</p>';}?>
				</div>

				<div class="form-input">
					<input type="file" class="cstm" name="profile_pic">
					<?php if (isset($_POST['submit'])){imgUpload();}						
						if(isset($data['message']['profile_pic']) && $data['status']=='error'){
						echo '<p class="error">'.$data['message']['profile_pic'].'</p>';}
					?>
				</div>

				<div class="form-input">
					<input type="text" name="father_name" placeholder="Father's Name" class="inp">
					<?php if(isset($data['message']['father_name']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['father_name'].'</p>';}?>
				</div>
					
				<div class="form-input">
					<input class="inp" type="text" name="username" placeholder="Username*"> 
					<?php if(isset($data['message']['username']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['username'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp" type="password" name="password" placeholder="Password*"> 
					<?php if(isset($data['message']['password']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['password'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp" type="password" name="confirm_password" placeholder="confirm Password*"> 
					<?php if(isset($data['message']['confirm_password']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['confirm_password'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp numbr_cstm_cls" type="text" name="mobile_number" placeholder="Number*" maxlength="10" minlength="10"> 
					<?php if(isset($data['message']['mobile_number']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['mobile_number'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp" type="text" name="email" placeholder="Email ID*"> 
					<?php if(isset($data['message']['email']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['email'].'</p>';}?>
				</div>

				<div class="form-input">
					<select name="state" class="inp">
						<option value="">State</option>
						<option value="Andhra Pradesh">Andhra Pradesh</option>
						<option value="Arunachal Pradesh">Arunachal Pradesh</option>
						<option value="Assam">Assam</option>
						<option value="Punjab">Punjab</option>
						<option value="Haryana">Haryana</option>
						<option value="Chandigarh">Chandigarh</option>
					</select>
					<?php if(isset($data['message']['state']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['state'].'</p>';}?>
				</div>
				
				<div class="form-input">
					<select name="city" class="inp">
						<option value="">City</option>
						<option value="Mohali">Mohali</option>
						<option value="Chandigarh">Chandigarh</option>
						<option value="Zirakpur">Zirakpur</option>
						<option value="Panchkula">Panchkula</option>
					</select>
					<?php if(isset($data['message']['city']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['city'].'</p>';}?>
				</div>	
				
				<div class="form-input">
					<input type="text" name="address" class="inp" placeholder="Address">
					<?php if(isset($data['message']['address']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['address'].'</p>';}?>
				</div>

				<div class="form-input">
					<input type="text" name="pincode" class="inp" placeholder="Pincode" maxlength="6" minlength="6">
					<?php if(isset($data['message']['pincode']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['pincode'].'</p>';}?>
				</div>

				<div class="form-input">
					<input type="date" name="dob" class="inp" placeholder="DOB">
					<?php if(isset($data['message']['dob']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['dob'].'</p>';}?>
				</div>

				<div class="form-input">
					<select name="course" class="inp">
						<option value="">Course</option>
						<option value="B.Sc">B.Sc</option>
						<option value="M.Sc">M.Sc</option>
						<option value="B.Tech">B.Tech</option>
						<option value="M.Tech">M.Tech</option>
					</select>
					<?php if(isset($data['message']['course']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['course'].'</p>';}?>
				</div>

				<div class="form-input cstm">
					Hobbies <br>
					<input type="checkbox" name="hobby[]" value="outdoor games"> Outdoor games <br>
					<input type="checkbox" name="hobby[]" value="indoor games"> Indoor games <br>
					<input type="checkbox" name="hobby[]" value="coding"> Coding <br>
					<input type="checkbox" name="hobby[]" value="riding"> Riding <br>
					<input type="checkbox" name="hobby[]" value="Other"> Other</td>
					<?php if(isset($data['message']['hobby']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['hobby'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp" id="submit" type="submit" name="submit">
				</div>
			</form>		
		</div>


	</body>
	</html>