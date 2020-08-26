<?php
session_start();
include('_dbconn.php');

?>

<div class="panel">
	<h2>Remove users</h2>

	<table class="table table-striped">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#ID</th>
	      <th scope="col">Name</th>
	      <th scope="col">Username</th>
	      <th scope="col">Level</th>
	      <th scope="col">Action</th>
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
						      <td>
						      	<form action="" method="POST">
									<input type="hidden" name="id" value="'.$row["admin_id"].'">
									<input type="submit" class="btn btn-sm btn-warning" name="delete" value="Delete">
							  	</form>
							  </td>
						   </tr>
							';
						}
					}
				}

			?>
		</tbody>
	</table>
</div>