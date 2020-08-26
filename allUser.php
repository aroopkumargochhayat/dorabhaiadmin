<?php
session_start();
include('_dbconn.php');

$id = $name = $level = $username ="";

?>

<div class="panel">
	<h2>All users</h2>

	<table class="table table-striped">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#ID</th>
	      <th scope="col">Name</th>
	      <th scope="col">Username</th>
	      <th scope="col">Level</th>
	    </tr>
	   </thead>
		  <tbody>
		    <?php
				$sql = 'select * from admin';
				$result = mysqli_query($conn, $sql);
				if($result) {
					if(mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							echo'
							<tr>
						      <th scope="row">'.$row["admin_id"].'</th>
						      <td>'.$row["admin_name"].'</td>
						      <td>'.$row["admin_username"].'</td>
						      <td>'.$row["admin_level"].'</td>
						   </tr>
							';
						}
					}
				}

			?>
		</tbody>
	</table>
</div>