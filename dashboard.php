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
					<button id="hide_show"> - Collapse Menu </button>
					<div class="collapse_menu">
						<a href="/adminpanel/dashboard.php?panel=all-user" id="alluser" name="alluser">All users</a>
						<a href="/adminpanel/dashboard.php?panel=add-user" id="adduser" name="adduser" >Add user</a>
						<a href="/adminpanel/dashboard.php?panel=remove-user" id="removeuser" name="removeuser">Remove user</a>
					</div>
					<a href="/adminpanel/_logout.php" id="logout">Logout</a>
				</div>
			</div>
			<div class="col-md-10 col-12 bg-white panel_container">
				<h2>Welcome <span>admin panel</span></h2>
				<div id="panel_section">
					<?php
					if (!isset($_GET["panel"]) || $_GET["panel"] == "all-user") {
						include 'allUser.php';
					} else if (isset($_GET["panel"]) && $_GET["panel"] == "add-user") {
						include 'addUser.php';
					} else if (isset($_GET["panel"]) && $_GET["panel"] == "remove-user") {
						include 'removeUser.php';
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<!-- get footer -->
	<?php include '_footer.php'; ?>

	

	<script type="text/javascript">
		$(document).ready(function() {
			$(".menu_div button").click(function(){
				$(".collapse_menu").slideToggle("slow");
				$(".menu_div button").toggleClass("expanded");
			    if ($(".menu_div button").hasClass("expanded")) {
			      $(".menu_div button").html("+ Show User Menu");
			    } else {
			      $(".menu_div button").html("- Collapse User Menu");
			    }
			});
		})
	</script>

	<!-- Remove User -->
	<?php
	if (isset($_POST["conf_delete"])) {
		$del = 'DELETE FROM admin WHERE admin_id='.$_POST["id"];
		$delres = mysqli_query($conn, $del);
		if ($delres) {
			header("location: /adminpanel/dashboard.php?panel=remove-user");
		}
	}
	?>


	<!-- Add User -->
	<?php
	$fullname = $username = $password = $repeat_password = $level = "";


	if(isset($_POST["add_user"])) {
		if(!empty($_POST["fullname"]) && !empty($_POST["username"]) && !empty($_POST["password"]) || !empty($_POST["repeat_password"])) {
			$username = $_POST["username"];
			$password = $_POST["password"];
			$repeat_password = $_POST["repeat_password"];
			if ($password == $repeat_password) {
				$chksql = "SELECT admin_username FROM admin WHERE admin_username='$username'";
				$chkres = mysqli_query($conn, $chksql);
				if (mysqli_num_rows($chkres) == 0) {
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

						unset($_SESSION["err"]);
						header("location: /adminpanel/dashboard.php?panel=all-user");

					} else {
						$_SESSION["err"] = "Unable to Insert.";
						header("location: /adminpanel/dashboard.php?panel=add-user");
					}
				} else{
					$_SESSION["err"] = "Username already exist.";
					header("location: /adminpanel/dashboard.php?panel=add-user");
				} 
			}
		} else {
			$_SESSION["err"] = "Fill all required fields.";
			header("location: /adminpanel/dashboard.php?panel=add-user");
		}
	}
	?>
</body>
</html>

