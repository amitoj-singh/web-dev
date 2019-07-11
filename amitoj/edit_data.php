<?php 

//enabling error reprting
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	require_once 'functions.php';
	connect_db();//connected to database amidb
	if ( isset($_POST['submit']) ){
		$data = submit_form($_POST);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

	// $id = 1;
	$retrieve = "select * from reg_users where id=".$_GET['user_id'];
	$result = $conn->query($retrieve);
	$row = $result->fetch_assoc();
	print_r($row);

	$hobbies = explode(', ', $row['hobby']);
?>

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

			$update = "update reg_users set name = '$name', gender = '$gender', profile_pic = '$profile_pic', father_name = '$father_name', username = '$username', password = '$password', mobile_number = '$mobile_number', email = '$email', state = '$state', city = '$city', address = '$address', pincode = '$pincode', dob = '$dob', course = '$course', hobby = '$hobby' where id=".$_GET['user_id'];
			if ($conn->query($update)){
				echo "<br>Data successfully updated";
				header('Location: retrieve_data.php');
			}
			else{
				echo "error updating: ".$conn->error;
			}

		}
			?>

		<div id="container">
			<form action="" method="post" id="form1" enctype="multipart/form-data">

				<div class="form-input">
					<input class="inp" type="text" name="name" placeholder="Name*" value="<?php echo $row['name']; ?>">
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['name'].'</p>';}?>
				</div>

				<div class="form-input cstm">
					<input type="radio" name="gender" value="Male" <?php if ($row['gender'] == "Male"){ echo 'checked';} ?>> Male
					<input type="radio" name="gender" value="Female" <?php if ($row['gender'] == "Female"){echo 'checked';} ?>> Female
					<input type="radio" name="gender" value="other" <?php if ($row['gender'] == "other"){echo 'checked';} ?>> other
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['gender'].'</p>';}?>
				</div>

				<div class="form-input">
					<input type="file" class="cstm" name="profile_pic"><?php if (isset($_POST['submit'])){imgUpload();}
						if(isset($data['message']['profile_pic']) && $data['status']=='error'){
						echo '<p class="error">'.$data['message']['profile_pic'].'</p>';}
					?>
				</div>

				<div class="form-input">
					<input type="text" name="father_name" placeholder="Father's Name" class="inp" value="<?php echo $row['father_name']; ?>">
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['father_name'].'</p>';}?>
				</div>
					
				<div class="form-input">
					<input class="inp" type="text" name="username" placeholder="Username*" value="<?php echo $row['username']; ?>"> 
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['username'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp" type="password" name="password" placeholder="Password*"> 
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['password'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp" type="password" name="confirm_password" placeholder="confirm Password*"> 
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['confirm_password'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp numbr_cstm_cls" type="text" name="mobile_number" placeholder="Number*" value="<?php echo $row['mobile_number']; ?>"> 
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['mobile_number'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp" type="text" name="email" placeholder="Email ID*" value="<?php echo $row['email']; ?>"> 
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['email'].'</p>';}?>
				</div>

				<div class="form-input">
					<select name="state" class="inp">
						<option value="">State</option>
						<option <?php if ($row['state']=="Andhra Pradesh"){echo 'selected';} ?> value="Andhra Pradesh">Andhra Pradesh</option>
						<option <?php if ($row['state']=="Arunachal Pradesh"){echo 'selected';} ?> value="Arunachal Pradesh">Arunachal Pradesh</option>
						<option <?php if ($row['state']=="Assam"){echo 'selected';} ?>value="Assam">Assam</option>
						<option <?php if ($row['state']=="Punjab"){echo 'selected';} ?> value="Punjab">Punjab</option>
						<option <?php if ($row['state']=="Haryana"){echo 'selected';} ?> value="Haryana">Haryana</option>
						<option <?php if ($row['state']=="Chandigarh"){echo 'selected';} ?> value="Chandigarh">Chandigarh</option>
					</select>
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['state'].'</p>';}?>
				</div>
				
				<div class="form-input">
					<select name="city" class="inp">
						<option value="">City</option>
						<option <?php if ($row['city']=="Mohali"){echo 'selected';} ?> value="Mohali">Mohali</option>
						<option <?php if ($row['city']=="Chandigarh"){echo 'selected';} ?> value="Chandigarh">Chandigarh</option>
						<option <?php if ($row['city']=="Zirakpur"){echo 'selected';} ?> value="Zirakpur">Zirakpur</option>
						<option <?php if ($row['city']=="Panchkula"){echo 'selected';} ?> value="Panchkula">Panchkula</option>
					</select>
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['city'].'</p>';}?>
				</div>	
				
				<div class="form-input">
					<input type="text" name="address" class="inp" placeholder="Address" value="<?php echo $row['address']; ?>">
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['address'].'</p>';}?>
				</div>

				<div class="form-input">
					<input type="number" name="pincode" class="inp" placeholder="Pincode" value="<?php echo $row['pincode']; ?>">
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['pincode'].'</p>';}?>
				</div>

				<div class="form-input">
					<input type="date" name="dob" class="inp" placeholder="DOB" value="<?php echo $row['dob']; ?>">
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['dob'].'</p>';}?>
				</div>

				<div class="form-input">
					<select name="course" class="inp">
						<option value="">Course</option>
						<option <?php if ($row['course']=="B.Sc"){echo 'selected';} ?> value="B.Sc">B.Sc</option>
						<option <?php if ($row['course']=="M.Sc"){echo 'selected';} ?> value="M.Sc">M.Sc</option>
						<option <?php if ($row['course']=="B.Tech"){echo 'selected';} ?> value="B.Tech">B.Tech</option>
						<option <?php if ($row['course']=="M.Tech"){echo 'selected';} ?> value="M.Tech">M.Tech</option>
					</select>
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['course'].'</p>';}?>
				</div>

				<div class="form-input cstm">
					Hobbies <br>
					<input type="checkbox" name="hobby[]" value="outdoor games" <?php if (in_array("outdoor games", $hobbies)){echo 'checked';} ?>> Outdoor games <br>
					<input type="checkbox" name="hobby[]" value="indoor games" <?php if (in_array("indoor games", $hobbies)){echo 'checked';} ?>> Indoor games <br>
					<input type="checkbox" name="hobby[]" value="coding" <?php if (in_array("coding", $hobbies)){echo 'checked';} ?>> Coding <br>
					<input type="checkbox" name="hobby[]" value="riding" <?php if (in_array("riding", $hobbies)){echo 'checked';} ?>> Riding <br>
					<input type="checkbox" name="hobby[]" value="Other" <?php if (in_array("Other", $hobbies)){echo 'checked';} ?>> Other <br>
					<?php if(isset($data) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['hobby'].'</p>';}?>
				</div>

				<div class="form-input">
					<input class="inp" id="submit" type="submit" name="submit"> 
				</div>
			</form>		
		</div>
</body>
</html>