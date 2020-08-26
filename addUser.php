
<?php
$fullname = $username = $password = $repeat_password = "";
?>
<div class="panel pt-5">
	<form method="post" action="" autocomplete="off">
	  <div class="form-group">
	    <label for="fullname">Enter Full name</label>
	    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter Full name">
	  </div>
	  <div class="form-group">
	    <label for="username">Username</label>
	    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
	  </div>
	  <div class="form-group">
	    <label for="pass">Password</label>
	    <input type="password" name="password" class="form-control" id="pass" placeholder="Password">
	  </div>
	  <div class="form-group">
	    <label for="rpass">Repeat Password</label>
	    <input type="password" name="repeat_password" class="form-control" id="rpass" placeholder="Repeat Password">
	  </div>
	  <div class="form-group">
	  	<label>Admin Level: </label>
	  	<select name="level" class="form-control">
			<option>Select</option>
			<option value="0">0 - Admin User</option>
			<option value="1">1 - Normal User</option>
		</select>
	  </div>
	  <button type="submit" name="add_user" class="btn btn-primary my-3">Submit</button>
	</form>

	<p class="text-danger font-weight-bold"><?php if(isset($_SESSION["err"])) {echo $_SESSION["err"];} ?></p>
</div>


