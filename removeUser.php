<?php
// session_start();
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
						      <td>';
						      if ($row["admin_level"] == 0) {
						      	echo '<button class="btn btn-success" disabled>Super User</button>';
						      } else {
						      	 echo'
						      	 	<div class="d-flex remove_btn">
								      	 <button id="remove" class="btn btn-warning mr-4">Remove</button>
								      	 <div class="confbox">
											<form id="delform" action="" method="POST">
												<input type="hidden" name="id" value="'.$row["admin_id"].'">
												<input type="submit" id="yes_btn" class="btn btn-sm btn-danger deleteBtn" name="conf_delete" value="Confirm" />
										  	</form>
											
										</div>
									</div>
								  </td>
							   </tr>';
						      }
						     
						}
					}
				}

			?>
		</tbody>
	</table>
</div>

<!-- <button id="no_btn" class="btn btn-primary mx-3" name="no">No</button> -->
