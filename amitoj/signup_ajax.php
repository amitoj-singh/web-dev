<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require_once 'functions.php';
	connect_db();//connected to database amidb

	$data = submit_form($_POST);

	if(isset($data) && $data['status']=='success') {

		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$profile_pic = $data['profile_pic'];
		$username = $_POST["username"];
		$password = md5($_POST["password"]);
		$mobile_number = $_POST["mobile_number"];
		$email = $_POST['email'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$course = $_POST['course'];
		$arr = isset($_POST['hobby'])?$_POST['hobby']:'';
		$hobby = implode(", ", $arr);

		require 'PHPMailer/src/Exception.php';
		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';		
		
		//header('Content-type: application/json');
		$mail = new PHPMailer(true);

		$mail->SMTPDebug = 0;                                       // Enable verbose debug output
	    $mail->isSMTP();                                            // Set mailer to use SMTP	    
	    $mail->Host       = 'smtp.gmail.com';  						// Specify main and backup SMTP servers	    
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'houky9@gmail.com';                     // SMTP username
	    $mail->Password   = '***********';                          // SMTP password
	    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect to

	    $mail->setFrom('houky9@gmail.com', 'Amitoj');
	    $mail->addAddress($email, $name);

	    $mail->Subject = 'registeration successful';
	    $mail->Body    = 'Hello, thank you for registering with quintsoft';
	    $mail->send();

		$sql = "insert into reg_users (name, gender, profile_pic, username, password, mobile_number, email, state, city, address, course, hobby) values ('$name', '$gender', '$profile_pic', '$username', '$password', '$mobile_number', '$email', '$state', '$city', '$address', '$course', '$hobby')";

			if ($conn->query($sql) === TRUE){
			}
			else{
				$err = "Error inserting data: " . $conn->error;
				die ($err);
			}
		}
		echo json_encode($data);
?>
