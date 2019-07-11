<?php
	session_start();
	if(empty($_SESSION)) {
   		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#button_ajax").click(function(e){
				e.preventDefault();
				var current_password = $("#current_password").val();
				var new_password = $("#new_password").val();		
				var re_password = $("#re_password").val();
				var submit = $(this).val();

				$data={current_password:current_password,new_password:new_password,re_password:re_password,submit:submit};

				$.ajax({
					data: $data,
					type: 'POST',
					url: 'change_pwd_ajax.php',
					success: function(result){
						console.log(result);
						var ret_data = JSON.parse(result);
						if (ret_data.status == "error") {
							$("#div1").html("<span class='error'>"+ret_data.data+"</span>");
						}
						else if (ret_data.status == "success") {
							//$('#div1').html("<span class='error'>"+ret_data.data+"</span>");
							window.location.href = 'login.php';
						}
					},
					error: function(xhr, status, error){
						alert ("XHR: "+xhr+" Status: "+status+" Error: "+error);
					}
				});
			});
		});
	</script>
	<title>password change</title>
	<link rel="stylesheet" type="text/css" href="profile_page.css">
	<style type="text/css">
		body{
			margin: 50px;
		}
		#button_ajax{
			background-color: rgb(133, 173, 173);			
		}
		.error{
			font-family: serif, sans-serif;
			font-size: 0.8em;
			margin: 20px;
		}
	</style>
</head>
<body>
	<form action="" method="post">	
		current password: <input type="password" id="current_password" name="current_password"> <br><br>
		new password: <input type="password" name="new_password" minlength="8" id="new_password"> <br><br>
		Confirm password: <input type="password" name="re_password" minlength="8" id="re_password"><br><br>
		<input type="submit" name="submit" value="submit" id="button_ajax">
		<h3><a href="profile_page.php">Cancel</a></h3>
		<div id="div1"></div>
	</form>
</body>
</html>