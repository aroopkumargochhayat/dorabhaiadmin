<?php
session_start();
include('_dbconn.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
	<!-- get header -->
	<?php include '_header.php'; ?>

	<div class="container">
		<div class="row">
			<div class="form_container">
				<form method="post" action="/adminpanel/_login.php">
				  <div class="form-group">
				    <label for="username">Enter Username</label>
				    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
				  </div>
				  <div class="form-group">
				    <label for="pass">Password</label>
				    <input type="password" name="password" class="form-control" id="pass" placeholder="Password">
				  </div>
				  <button type="submit" name="login" class="btn btn-primary">Submit</button>
				</form>
				<p class="text-danger"><?php if(isset($_SESSION["msg"])){ echo $_SESSION["msg"];}?></p>
			</div>
		</div>
	</div>

	<!-- get footer -->
	<?php include '_footer.php'; ?>
</body>
</html>
