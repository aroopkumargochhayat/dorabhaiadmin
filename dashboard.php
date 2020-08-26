<?php

session_start();
include('_dbconn.php');
if (!isset($_SESSION["user_id"])) {
	header("location: /adminpanel/index.php?unauthorized_access");
}
$id = $name = $level = $username ="";

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<!-- get header -->
	<?php include '_header.php'; ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2 col-12 px-0">
				<div class="menu_div">
					<button id="alluser" name="alluser">All users</button>
					<button id="adduser" name="adduser" >Add user</button>
					<button id="removeuser" name="removeuser">Remove user</button>
					<a href="/adminpanel/_logout.php">Logout</a>
				</div>
			</div>
			<div class="col-md-10 col-12 bg-white panel_container">
				<h2>Welcome <span>admin panel</span></h2>
				<div id="load"></div>
			</div>
		</div>
	</div>

	<!-- get footer -->
	<?php include '_footer.php'; ?>

	<script>
		$(document).ready(function() {
			// $("#load").load("allUser.php");
	        $("#alluser").click(function() {
	          	$("#load").load("allUser.php");
	        });
	        $("#adduser").click(function() {
	          	$("#load").load("addUser.php");
	        });
	         $("#removeuser").click(function() {
	          	$("#load").load("removeUser.php");
	        });
      });
	</script>

	<!-- Remove User -->
	<?php
	if (isset($_POST["delete"])) {
		$del = 'DELETE FROM admin WHERE admin_id='.$_POST["id"];
		$delres = mysqli_query($conn, $del);
		if ($delres) {
			echo "Deleted";
		}
	}
	?>

	<!-- Add User -->
	<?php
	$fullname = $username = $password = $repeat_password = $level = "";


	if(isset($_POST["add_user"])) {
		if(!empty($_POST["fullname"]) && !empty($_POST["username"]) && !empty($_POST["password"]) || !empty($_POST["repeat_password"])) {
			$password = $_POST["password"];
			$repeat_password = $_POST["repeat_password"];
			if ($password == $repeat_password) {
				$sql = "INSERT INTO admin (admin_name, admin_level, admin_username, admin_password) VALUES(?, ?, ?, ?)";
				$result = mysqli_prepare($conn, $sql);

				if ($result) {
					// Bind variables to prepare statement as parameters
					mysqli_stmt_bind_param($result, 'siss', $fullname, $level, $username, $hash_password);

					// Variables of name and age
					$fullname = $_POST["fullname"];
					$level = $_POST["level"];
					$username = $_POST["username"];
					$hash_password = md5($_POST["password"]);

					// Execute prepare statement
					mysqli_stmt_execute($result);

					// Show affected rows (Optional)
					echo mysqli_stmt_affected_rows($result). "Row(s) Inserted!";
				} else {
					echo "";
				}
			}
		} else {
			echo "";
		}
	}
	?>
</body>
</html>
