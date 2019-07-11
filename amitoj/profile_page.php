<?php
	require_once 'functions.php'; 
	connect_db();//connected to database amidb	
	global $conn;

	session_start();

	if(empty($_SESSION)) {
   		header('Location: login.php');
	}

	$sql = "select * from reg_users where username='".$_SESSION['username']."'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		$profile_data = $result->fetch_assoc();
	}
	
	if ( isset($_POST['edit']) ){
		header('Location: update_profile.php');
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
			<div class="child">
				<img width="300px" src="http://localhost/amitoj/uploads/<?php echo $profile_data['profile_pic']; ?>">
			</div>
		
			<div class="child" id="pic">
				<button type="submit" name="edit">Edit profile</button>
				<!-- <button type="submit" name="changepass"><a href="changepass.php">Change Password</a></button> -->
				<button type="submit" name="logout">Logout</button>

				<div class="row">
					<label>Welcome <?php echo $profile_data['name']; ?></label>
				</div>
				<br>

				<div class="row">
					<label>Gender: <?php 
							if ($profile_data['gender'] == "Male"){ echo 'male';}
							elseif ($profile_data['gender'] == "Female") { echo 'Female';}
							elseif ($profile_data['gender'] == "other"){echo 'Other';}
						?>
					</label>
				</div>
				<br>
				
				<div class="row">
					<label>username: <?php echo $profile_data['username']; ?></label>
				</div>
				<br>

				<div class="row">
					<label>Mobile number: <?php echo $profile_data['mobile_number']; ?></label>
				</div>
				<br>

				<div class="row">
					<label>E-mail ID: <?php echo $profile_data['email']; ?></label>
				</div>
				<br>

				<div class="row">
					<label>State: <?php 
							if ($profile_data['state']=="Andhra Pradesh"){echo 'Andhra Pradesh';} 
							elseif ($profile_data['state']=="Arunachal Pradesh"){echo 'Arunachal Pradesh';}
							elseif ($profile_data['state']=="Assam"){echo 'Assam';}
							elseif ($profile_data['state']=="Punjab"){echo 'Punjab';}
							elseif ($profile_data['state']=="Haryana"){echo 'Haryana';}
							elseif ($profile_data['state']=="Chandigarh"){echo 'Chandigarh';}
						?>
					</label>
				</div>
				<br>

				<div class="row">
					<label>City: <?php 
							if ($profile_data['city']=="Mohali"){echo 'Mohali';}
							elseif ($profile_data['city']=="Chandigarh"){echo 'Chandigarh';}
							elseif ($profile_data['city']=="Zirakpur"){echo 'Zirakpur';}
							elseif ($profile_data['city']=="Panchkula"){echo 'Panchkula';}
						?>
					</label>
				</div>
				<br>

				<div class="row">
					<label>Address: <?php echo $profile_data['address']; ?></label>					
				</div>
				<br>

				<div class="row">
					<label>Course: <?php 
							if ($profile_data['course']=="B.Sc"){echo 'B.Sc';}
							elseif ($profile_data['course']=="M.Sc"){echo 'M.Sc';}
							elseif ($profile_data['course']=="B.Tech"){echo 'B.Tech';}
							elseif ($profile_data['course']=="M.Tech"){echo 'M.Tech';}
						?>
					</label>
				</div>
				<br>

				<div class="row">
					<label>Hobbies: <?php 
							$arr = isset($profile_data['hobby']) ? $profile_data['hobby'] : '';
							$hobbies = explode(", ", $arr);
							echo $arr;
						?>
					</label>
				</div>
			</div>
		</div>
	</form>
</body>
</html>