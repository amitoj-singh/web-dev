	<!DOCTYPE html>
	<html lang="en-us">
	<head>
		<title>registration form</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>

		<?php

			//enabling error reprting
			ini_set('display_errors', 1);
			error_reporting(E_ALL);

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

			if (isset($_POST['submit']) && !empty($_POST)){;
				$name = $_POST["name"];
				$gender = isset($_POST["gender"])?$_POST["gender"]:'';
				$fathers_name = $_POST["Father_name"];
				$username = $_POST["username"];
				$password = $_POST["password"];
				$confirm_password = $_POST["confirm_password"];
				$number = $_POST["Mobile_number"];
				$email = $_POST["email_ID"];

				$data = array("name"=>$name, "gender"=>$gender, "username"=>$username, "password"=>$password, "confirm password"=>$confirm_password, "number"=>$number, "email"=>$email);
				//checking the required fields if they remain unfilled by the user
				$error = ""; //marking empty to check during inserting data whether errors occured or not
				$error = validation($data);
				// displaying empty fields in the
				
			}//isset ends
		?>

		<header>
			<h1>Basic Registeration form HTML and CSS</h1>
		</header>

		<div id="container">
			<div class="error">
			<?php
				if(isset($_POST['submit'])){
					for ($i=0; $i <count($error) ; $i++) {		
						echo $error[$i];
					}
				}
			?>
			</div>

			<form action="index.php" method="post" id="form1" enctype="multipart/form-data" target="_self">

				<div class="form-input">
					<input class="inp" type="text" name="name" placeholder="Name*"> 
				</div>

				<div class="form-input inp cstm_border">
					<input type="radio" name="gender" value="Male"> Male
					<input type="radio" name="gender" value="Female"> Female
					<input type="radio" name="gender" value="other"> other
				</div>

				<div class="form-input">
					<input type="file" class="inp cstm_border" name="profile_pic">
				</div>

				<div class="form-input">
					<input type="text" name="Father_name" placeholder="Father's Name" class="inp">
				</div>
					
				<div class="form-input">
					<input class="inp" type="text" name="username" placeholder="Username*"> 
				</div>

				<div class="form-input">
					<input class="inp" type="password" name="password" placeholder="Password*"> 
				</div>

				<div class="form-input">
					<input class="inp" type="password" name="confirm_password" placeholder="confirm Password*"> 
				</div>

				<div class="form-input">
					<input class="inp numbr_cstm_cls" type="text" name="Mobile_number" placeholder="Number*"> 
				</div>

				<div class="form-input">
					<input class="inp" type="email" name="email_ID" placeholder="Email ID*"> 
				</div>

				<div class="form-input">
					<select name="State" class="inp">
						<option value="">State</option>
						<option value="Andhra Pradesh">Andhra Pradesh</option>
						<option value="Arunachal Pradesh">Arunachal Pradesh</option>
						<option value="Assam">Assam</option>
						<option value="Punjab">Punjab</option>
						<option value="Haryana">Haryana</option>
						<option value="Chandigarh">Chandigarh</option>
					</select>
				</div>
				
				<div class="form-input">
					<select name="city" class="inp">
						<option value="">City</option>
						<option value="Mohali">Mohali</option>
						<option value="Chandigarh">Chandigarh</option>
						<option value="Zirakpur">Zirakpur</option>
						<option value="Panchkula">Panchkula</option>
					</select>
				</div>	
				
				<div class="form-input">
					<input type="text" name="Address" class="inp" placeholder="Address">
				</div>

				<div class="form-input">
					<input type="number" name="pincode" class="inp" placeholder="Pincode">
				</div>

				<div class="form-input">
					<input type="date" name="DOB" class="inp" placeholder="DOB">
				</div>

				<div class="form-input">
					<select name="course" class="inp">
						<option value="">Course</option>
						<option value="B.Sc">B.Sc</option>
						<option value="M.Sc">M.Sc</option>
						<option value="B.Tech">B.Tech</option>
						<option value="M.Tech">M.Tech</option>
					</select>
				</div>

				<div class="form-input inp cstm_border" id="cstm_hobbies">
					Hobbies <br>
					<input type="checkbox" name="hobby[]" value="outdoor games"> Outdoor games <br>
					<input type="checkbox" name="hobby[]" value="indoor games"> Indoor games <br>
					<input type="checkbox" name="hobby[]" value="coding"> Coding <br>
					<input type="checkbox" name="hobby[]" value="riding"> Riding <br>
					<input type="checkbox" name="hobby[]" value="Other"> Other</td>
				</div>



				<div class="form-input">
					<input class="inp" id="submit" type="submit" name="submit"> 
				</div>
			</form>		
		</div>


	</body>
	</html>
