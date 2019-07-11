<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-color: #e6f0ff;
			margin: 20px;
		}

		table, tr, td, th{
			border: 1px solid black;
			border-collapse: collapse;
		}

		table{
			width: 100%;
		}

		td{
			padding: 5px 0px 5px 5px;
		}

		th{
			padding: 8px;
		}

		#theader{
			background-color: #003cb3;
			color: white;
			font-family: Courier;
		}

		#rows:nth-child(odd){
			background-color: #f2f2f2;
		}

		#rows:hover{
			background-color: #80aaff;
		}		
		#download, #import_button{
			width: -webkit-fill-available;
		    margin: 10px 0px;
		    padding: 10px;
		    background-color: #80aaff;
		    font-size: larger;
		    font-weight: bolder;
		}
	</style>
</head>
<body>

<?php
	
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	
	include'functions.php';
	connect_db();

	$retrieve = "select id, name, gender, email, username, mobile_number, hobby from reg_users";
	$result = $conn->query($retrieve);

	if (mysqli_num_rows($result) > 0) {
    // output data of each row
	$i = 1;
?>

<form method="post" action="" enctype="multipart/form-data">
	<input type="file" name="import_csv" id="import_csv">
	<button type="submit" name="import" id="import_button">IMPORT CSV</button>
</form>

<table>
	<tr id="theader"> 
		<th>S.No.</th>
		<th>name</th> 
		<th>gender</th>
		<th>email</th>
		<th>username</th>
		<th>Mobile number</th> 
		<th>hobby</th>
		<th colspan="2">Action</th>
	</tr>
<?php
    while($row = mysqli_fetch_assoc($result)) {
    	?>
    	
    		<tr id="rows"> 
    			<td><?php echo $i; $i++; ?></td>
    			<td><?php echo $row["name"] ?></td>
    			<td><?php echo $row["gender"] ?></td>
    			<td><?php echo $row["email"] ?></td>
    			<td><?php echo $row["username"] ?></td>
    			<td><?php echo $row["mobile_number"] ?></td>
    			<td><?php echo $row["hobby"] ?></td>
 				<td><a href="edit_data.php?user_id=<?php echo $row["id"] ?>" target="_blank" >edit</a></td>
 				<td><a href="delete_data.php?user_id=<?php echo $row["id"] ?>">delete</a></td>
    		</tr>    	
    <?php 
}?>
</table>
<?php
	} 
	else {
    echo "0 results";
	}
?>
	<form method="post">	
		<button type="submit" name="download" id="download">EXPORT DATA</button>
	</form>
<?php
	//code to download data from database (Export Data)
	if (isset($_POST['download'])){
		ob_clean();
		$fp = fopen('php://output', 'w');
		// query to get data from database
		$query = mysqli_query($conn, "SELECT * FROM reg_users order by id asc");
		$field = mysqli_field_count($conn);
		// create array with field names
		$arr = array('S.No.','name','Father name','username','password','mobile Number','Email ID','State','city','address','pincode', 'Date of Birth','course','gender','profile Pic','hobbies');
		fputcsv($fp, $arr);
		// loop through database query and fill each row at once
		$i = 1;
		while($row = mysqli_fetch_assoc($query)) {
			$row['id'] = $i++; //increments the value of i after assigning to the variable on left hand side
			$row['profile_pic'] = "http://localhost/amitoj/uploads/".$row['profile_pic'];
			fputcsv($fp, $row);
		}	
		fclose($fp);

		header("Content-Disposition: attachment; filename=reg_users.csv");
		header("Content-type: text/x-csv");
	}

	//code to upload csv file and save in database after validation
	if (isset($_POST['import'])){
		ob_clean();
		$filename = $_FILES['import_csv']['tmp_name'];
		if($_FILES["import_csv"]["size"] > 0){

			$i=0;
			$fp = fopen($filename, "r");

			while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
			
				if ($i == 0) {
					$i++;
					continue;
				}
				$name = $data['1'];
				$gender = $data['13'];
				$profile_pic = $data['14'];
				$username = $data['3'];
				$password = md5($data['4']);
				$mobile_number = $data['5'];
				$email = $data['6'];
				$state = $data['7'];
				$city = $data['8'];
				$address = $data['9'];
				$course = $data['12'];
				$hobby = $data['15'];

				$import_data = array("name"=>$name, "gender"=>$gender, "profile_pic"=>$profile_pic, "username"=>$username, "password"=>$password, "mobile_number"=>$mobile_number, "email"=>$email, "state"=>$state, "city"=>$city, "address"=>$address, "course"=>$course, "hobby"=>$hobby);
				$valid_data = import_validation($import_data);

				$profile_pic = $valid_data['profile_pic'];

				if ($valid_data['status'] == "success"){

					$sql = "insert into reg_users (name, gender, profile_pic, username, password, mobile_number, email, state, city, address, course, hobby) values ('$name', '$gender', '$profile_pic', '$username', '$password', '$mobile_number', '$email', '$state', '$city', '$address', '$course', '$hobby')";

					if ($conn->query($sql) === TRUE){
						//header('Location: retrieve_data.php');
					}
					else{
						$err = "Error inserting data: " . $conn->error;
						die ($err);
					}
				}
				else{
					echo "<pre>";
					print_r($valid_data);
					echo "</pre>";
				}
			fclose($fp);
		}
	}
?>