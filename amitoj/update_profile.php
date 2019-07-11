<?php
	require_once 'functions.php'; 
	connect_db();//connected to database amidb	
	global $conn;

	session_start();

	if(empty($_SESSION)) {
   		header('Location: login.php');
	}

	function update_validation($form_data){
		$response=array();
		$error_messages=array();

		if(empty(trim($form_data['name']))){
			$error_messages['name']='Name is required';
		}

		if(empty(trim($form_data['gender']))){
			$error_messages['gender']='gender is required';	
		}

		$flag = imgUpload();
		if ($flag['flag'] == 2) {
			$error_messages['profile_pic']='upload jpg, png or jpeg file only';
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

		if(empty(trim($form_data['state']))){
			$error_messages['state']='state is required';
		}

		if(empty(trim($form_data['city']))){
			$error_messages['city']='city is required';
		}

		if(empty(trim($form_data['address']))){
			$error_messages['address']='address is required';
		}

		if(empty(trim($form_data['course']))){
			$error_messages['course']='course is required';
		}

		if(empty($form_data['hobby'])){
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

	$sql = "select * from reg_users where username='".$_SESSION['username']."'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		$profile_data = $result->fetch_assoc();
	}
	
	if ( isset($_POST['update']) ){
		$data = update_validation($_POST);

		if(isset($data) && $data['status']=='success') {
			echo '<p class="error">'.$data['message'] .'</p>';

			$name = $_POST['name'];
			$gender = $_POST['gender'];
			$temp = imgUpload();
			$temp = $temp['new_file_name'];
			if (strpos($temp, 'jpg') !== false || strpos($temp, 'jpeg') !== false || strpos($temp, 'png') !== false) {
				$profile_pic = $temp;
			}
			else{
				$profile_pic = $profile_data['profile_pic'];
			}
			// $username = $_POST["username"];
			$mobile_number = $_POST["mobile_number"];
			// $email = $_POST['email'];
			$state = $_POST['state'];
			$city = $_POST['city'];
			$address = $_POST['address'];
			$course = $_POST['course'];
			$arr = isset($_POST['hobby'])?$_POST['hobby']:'';
			$hobby = implode(", ", $arr);

			$update = "update reg_users set name = '$name', gender = '$gender', profile_pic = '$profile_pic', mobile_number = '$mobile_number', state = '$state', city = '$city', address = '$address', course = '$course', hobby = '$hobby' where id=".$profile_data['id'];
			if ($conn->query($update)){
				header('Location: profile_page.php');
			}
			else{
				echo "error updating: ".$conn->error;
			}
		}		
	}

	elseif (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $profile_data['name']."'s profile" ?></title>
	<link rel="stylesheet" type="text/css" href="profile_page.css">
</head>

<body>
	<form action="" method="post" enctype="multipart/form-data">
		<!-- <div id="nav">
			<button type="submit">Update profile</button>
			<button type="submit">Change Password</button>
			<button type="submit">Logout</button>
		</div> -->

		<div id="flc">
			<div class="child" id="con1">
				<img width="300px" src="http://localhost/amitoj/uploads/<?php echo $profile_data['profile_pic']; ?>"><br>
				<input type="file" name="profile_pic" style="width: 290px;" value="<?php echo $profile_data['profile_pic']; ?>">
				<?php if(isset($data['message']['profile_pic']) && $data['status']=='error'){
						echo '<p class="error">'.$data['message']['profile_pic'].'</p>';}?><br><br>
				<button type="submit" name="update">Update profile</button><br>
				<button type="submit" name="changepass"><a href="changepass.php">Change Password</a></button><br>
				<button><a href="profile_page.php">Cancel</a></button>
			</div>
		
			<div class="child" id="pic">
				<!-- <button type="submit" name="update">Update profile</button>
				<button type="submit" name="changepass"><a href="changepass.php">Change Password</a></button> -->
				<!-- <button type="submit" name="logout">Logout</button> -->

				<div class="row">
					<label>Welcome <?php echo $profile_data['name']; ?></label>
					<input type="text" name="name" value="<?php echo $profile_data['name']; ?>">
					<?php if(isset($data['message']['name']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['name'].'</p>';}?>
				</div>
				<br>

				<div class="row">
					<label>Gender</label>
					<input type="radio" name="gender" value="Male" <?php if ($profile_data['gender'] == "Male"){ echo 'checked';} ?>> Male
					<input type="radio" name="gender" value="Female" <?php if ($profile_data['gender'] == "Female"){echo 'checked';} ?>> Female
					<input type="radio" name="gender" value="other" <?php if ($profile_data['gender'] == "other"){echo 'checked';} ?>> other
				</div>
				<br>
				
				<div class="row">
					<label>username</label>
					<input type="text" name="username" value="<?php echo $profile_data['username']; ?>" disabled>
				</div>
				<br>

				<div class="row">
					<label>Mobile number</label>
					<input type="text" name="mobile_number" maxlength="10" minlength="10" value="<?php echo $profile_data['mobile_number']; ?>">
					<?php if(isset($data['message']['mobile_number']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['mobile_number'].'</p>';}?>
				</div>
				<br>

				<div class="row">
					<label>E-mail ID</label>
					<input type="text" name="email" value="<?php echo $profile_data['email']; ?>" disabled>
				</div>
				<br>

				<div class="row">
				<label>State</label>
					<select name="state">
						<option value="">State</option>
						<option value="Andhra Pradesh" <?php if ($profile_data['state']=="Andhra Pradesh"){echo 'selected';} ?>>Andhra Pradesh</option>
						<option value="Arunachal Pradesh" <?php if ($profile_data['state']=="Arunachal Pradesh"){echo 'selected';} ?>>Arunachal Pradesh</option>
						<option value="Assam" <?php if ($profile_data['state']=="Assam"){echo 'selected';} ?>>Assam</option>
						<option value="Punjab" <?php if ($profile_data['state']=="Punjab"){echo 'selected';} ?>>Punjab</option>
						<option value="Haryana" <?php if ($profile_data['state']=="Haryana"){echo 'selected';} ?>>Haryana</option>
						<option value="Chandigarh" <?php if ($profile_data['state']=="Chandigarh"){echo 'selected';} ?>>Chandigarh</option>
					</select>
					<?php if(isset($data['message']['state']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['state'].'</p>';}?>
				</div>
				<br>

				<div class="row">
					<label>City</label>
					<select name="city">
						<option value="">City</option>
						<option <?php if ($profile_data['city']=="Mohali"){echo 'selected';} ?> value="Mohali">Mohali</option>
						<option <?php if ($profile_data['city']=="Chandigarh"){echo 'selected';} ?> value="Chandigarh">Chandigarh</option>
						<option <?php if ($profile_data['city']=="Zirakpur"){echo 'selected';} ?> value="Zirakpur">Zirakpur</option>
						<option <?php if ($profile_data['city']=="Panchkula"){echo 'selected';} ?> value="Panchkula">Panchkula</option>
					</select>
					<?php if(isset($data['message']['city']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['city'].'</p>';}?>
				</div>
				<br>

				<div class="row">
					<label>Address</label>
					<input type="text" name="address" value="<?php echo $profile_data['address']; ?>">
					<?php if(isset($data['message']['address']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['address'].'</p>';}?>
				</div>
				<br>

				<div class="row">
				<label>Course</label>
					<select name="course">
						<option value="">Course</option>
						<option <?php if ($profile_data['course']=="B.Sc"){echo 'selected';} ?> value="B.Sc">B.Sc</option>
						<option <?php if ($profile_data['course']=="M.Sc"){echo 'selected';} ?> value="M.Sc">M.Sc</option>
						<option <?php if ($profile_data['course']=="B.Tech"){echo 'selected';} ?> value="B.Tech">B.Tech</option>
						<option <?php if ($profile_data['course']=="M.Tech"){echo 'selected';} ?> value="M.Tech">M.Tech</option>
					</select>
					<?php if(isset($data['message']['course']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['course'].'</p>';}?>
				</div>
				<br>

				<?php 
					$arr = isset($profile_data['hobby']) ? $profile_data['hobby'] : '';
					$hobbies = explode(", ", $arr);
				?>
				<div class="row">
					<label>Hobbies</label><br>
					<input type="checkbox" name="hobby[]" value="outdoor games" <?php if (in_array("outdoor games", $hobbies)){echo 'checked';} ?>> Outdoor games <br>
					<input type="checkbox" name="hobby[]" value="indoor games" <?php if (in_array("indoor games", $hobbies)){echo 'checked';} ?>> Indoor games <br>
					<input type="checkbox" name="hobby[]" value="coding" <?php if (in_array("coding", $hobbies)){echo 'checked';} ?>> Coding <br>
					<input type="checkbox" name="hobby[]" value="riding" <?php if (in_array("riding", $hobbies)){echo 'checked';} ?>> Riding <br>
					<input type="checkbox" name="hobby[]" value="Other" <?php if (in_array("Other", $hobbies)){echo 'checked';} ?>> Other <br>
					<?php if(isset($data['message']['hobby']) && $data['status']=='error'){
					echo '<p class="error">'.$data['message']['hobby'].'</p>';}?>
				</div>
			</div>
		</div>
	</form>
</body>
</html>