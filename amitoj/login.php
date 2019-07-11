<!DOCTYPE html>
<html lang="en">
<head>
	<title>login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="login_styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script type="text/javascript" src="login_jquery.js"></script>
</head>
<body>
	<div id="div1"></div>
	<div id="container">
		<p id="signin">Sign In</p>
		<form action="" method="post" id="form1">
			<div class="inp" id="username">	
				<input type="text" name="username" placeholder="Username" class="fields" id="username1">
			</div>
			
			<div class="inp" id="password">
				<input type="password" name="password" placeholder="Password" class="fields" id="password1">
			</div>

			<div class="inp" id="submit">	
				<input type="submit" name="login" value="Login" class="fields" id="login">
			</div>
		</form>
		<p id="crtacc">don't have an account? <a href="signup.php">create Account</a></p>
	</div>
</body>
</html>