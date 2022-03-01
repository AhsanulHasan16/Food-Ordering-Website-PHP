<?php

	include('Reusables/menu.php');

?>


	<div class="main-content">
		<div class="wrapper">
			<h1>Change Password</h1>
			<br><br>


			<?php 													

				if(isset($_GET['id'])){						 // Getting the id for later in the form . Line: 48. 

					$id = $_GET['id'];
				}

			?>

			<form action="" method="POST">
				
				<table class="tbl_30">
					<tr>
						<td>Current Password: </td>
						<td>
							<input type="password" name="current_password" placeholder="Current Password">
						</td>
					</tr>

					<tr>
						<td>New Password: </td>
						<td>
							<input type="password" name="new_password" placeholder="New Password">
						</td>
					</tr>

					<tr>
						<td>Confirm Password: </td>
						<td>
							<input type="password" name="confirm_password" placeholder="Confirm Password">
						</td>
					</tr>


					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" name="submit" value="Change Password" class="btn-secondary">
						</td>
					</tr>


				</table>

			</form>



		</div>
	</div>



<?php
		
	if(isset($_POST['submit'])){

		//echo "Changed!";    Checking whether the change pass button was pressed or not. 

		$id = $_POST['id'];
		$current_password = md5($_POST['current_password']);									// Getting all the data from the form.
		$new_password = md5($_POST['new_password']);
		$confirm_password = md5($_POST['confirm_password']);


		$sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";     // As usual the query for the DB. 

		$res = mysqli_query($conn, $sql);                        // Executing the query as usual. 

		if($res == true){

			$count = mysqli_num_rows($res);						// Checking whether data is available. 

			if($count == 1){

				// User Exists! Password can be changed!
				// echo "User Found!";

				if($new_password == $confirm_password){

					// Update the pass. 
					//echo "Pass Matched!";    			// $sql2 used because $sql is already in use.

					$sql2 = "UPDATE tbl_admin SET
						password = '$new_password'
						WHERE id = $id 											
					";

					$res2 = mysqli_query($conn, $sql2);        // As always executing the sql query. $res2 because $res already in use.

					if($res2 == true){

						$_SESSION['change_pass'] = "<div class = 'success'>Password Changed Successfully! </div>";
						header('location:'.HOMEURL.'admin/admin-management.php');

					} else {

						$_SESSION['change_pass'] = "<div class = 'error'> Failed To Change Password! </div>";
						header('location:'.HOMEURL.'admin/admin-management.php');
					}



				} else {

					$_SESSION['pass_not_matched'] = "<div class = 'error'>Password Did Not Match! </div>";
					header('location:'.HOMEURL.'admin/admin-management.php');

				}

			} else {

				// User Doesn't Exist! So Time For Redirection!

				$_SESSION['user_not_found'] = "<div class = 'error'>User Not Found! </div>";
				header('location:'.HOMEURL.'admin/admin-management.php');


			}
		}

	}

?>


<?php
	include('Reusables/footer.php');
?>