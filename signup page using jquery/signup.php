<!DOCTYPE html>
<html>
<head>
	<title>Signup page</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script type="text/javascript" src="signupjquery.js"></script>
	<link rel="stylesheet" type="text/css" href="signup_style.css">
</head>
<body>
	<header>
		<h1>SIGNUP</h1>
	</header>

	<div id="container">
			<form action="" method="post" id="form1" enctype="multipart/form-data">
				
				<h2 id="basic" >Basic Details</h2>
				<section id="basic_sec" class="section">					
					<div class="form-input">
						<input class="inp" type="text" name="name" placeholder="Name" id="name"> 
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
						<input class="inp" type="text" name="username" placeholder="Username*" id="username"> 
						<?php if(isset($data['message']['username']) && $data['status']=='error'){
						echo '<p class="error">'.$data['message']['username'].'</p>';}?>
					</div>

					<div class="form-input">
						<input class="inp" type="text" name="email" placeholder="Email ID*" id="email"> 
						<?php if(isset($data['message']['email']) && $data['status']=='error'){
						echo '<p class="error">'.$data['message']['email'].'</p>';}?>
					</div>

					<div class="form-input">
						<input class="inp" type="password" name="password" placeholder="Password*" id="password"> 
						<?php if(isset($data['message']['password']) && $data['status']=='error'){
						echo '<p class="error">'.$data['message']['password'].'</p>';}?>
					</div>

					<div class="form-input">
						<input class="inp" type="password" name="confirm_password" placeholder="confirm Password*" id="confirm_password"> 
						<?php if(isset($data['message']['confirm_password']) && $data['status']=='error'){
						echo '<p class="error">'.$data['message']['confirm_password'].'</p>';}?>
					</div>
					<button type="button" name="next_basic" class="inp" id="basic_button">next</button>
				</section>

				<h2 id="contact" >Contact Details</h2>
				<section id="contact_sec" class="section">
					<div class="form-input">
						<input class="inp numbr_cstm_cls" type="text" name="mobile_number" placeholder="Number*" maxlength="10" minlength="10" id="mobile_number"> 
						<?php if(isset($data['message']['mobile_number']) && $data['status']=='error'){
						echo '<p class="error">'.$data['message']['mobile_number'].'</p>';}?>
					</div>

					<div class="form-input">
						<select name="state" class="inp" id="state">
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
						<select name="city" class="inp" id="city">
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
						<input type="text" name="address" class="inp" placeholder="Address" id="address">
						<?php if(isset($data['message']['address']) && $data['status']=='error'){
						echo '<p class="error">'.$data['message']['address'].'</p>';}?>
					</div>
					<button type="button" name="next_contact" class="inp" id="contact_button">next</button>
				</section>

				<h2 id="interest">Interests</h2>
				<section id="interest_sec" class="section">
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
					<button type="submit" name="submit" class="inp" id="submit">submit</button>
				</section>
			</form>		
		</div>
</html>
