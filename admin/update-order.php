<?php 
	
	include('Reusables/menu.php');

?>

<div class = "main-content"> 
	<div class = "wrapper">
		<h1>Update Order</h1>
			
			<br> <br> 

			<?php

				// Checking whether id is set or not! 

				if(isset($_GET['id'])){

					// Id set. So getting the details of the order! 

					$id = $_GET['id']; 

					// The order id. Details will be presented based on this! 

					// Now to get the details by using SQL query! 

					$sql = "SELECT * FROM tbl_order WHERE id=$id";

					$res = mysqli_query($conn, $sql); 		// Executing the Query! 

					$count = mysqli_num_rows($res); 		// Counting rows! 

					if($count == 1){

						// Data Available!

						$row = mysqli_fetch_assoc($res); 

						$food = $row['food'];
						$price = $row['price'];
						$qty = $row['qty'];
						$status = $row['status'];
						$customer_name = $row['customer_name'];


					} else {

						// Data Not Available! So redirecting to management page!

						header('location:'.HOMEURL.'admin/order-management.php');

					}

				} else {

					// Id invalid or not set. So redirecting to management page! 

					header('location:'.HOMEURL.'admin/order-management.php');
				}

			?>

			<form action="" method="POST">
				
				<table class="tbl-30">
						
					<tr>

						<td>Food Name: </td>
						<td><b><?php echo $food; ?></b></td>					<!-- <b> tag used to bold the food name! -->

					</tr>

					<tr>
						
						<td>Price</td>
						<td><b> $ <?php echo $price; ?></b></td>

					</tr>

					<tr>

						<td>Qty</td>
						<td>
							
							<input type="number" name="qty" value="<?php echo $qty; ?>">

						</td>

					</tr>

					<tr>
						
						<td>Status</td>
						<td>
							
							<select name="status">
								
								<option <?php if($status=="Ordered"){echo "Selected"; } ?> value="Ordered">Ordered</option>
								<option <?php if($status=="On The Way"){echo "Selected"; } ?> value="On The Way">On The Way</option>
								<option <?php if($status=="Delivered"){echo "Selected"; } ?> value="Delivered">Delivered</option>
								<option <?php if($status=="Cancelled"){echo "Selected"; } ?> value="Cancelled">Cancelled</option>

							</select>

						</td>

					</tr>	

					<!-- If needed to, we can update everything. But we don't need to update the customer details now. -->
					<!-- So I ain't adding those. If in the future needed, then those infos will be added below too.  -->

					<tr>
						
						<td>Customer Name: </td>
						<td>
							
							<input type="text" name="customer_name" value="<?php echo $customer_name; ?>">

						</td>

					</tr>

					<tr>
						
						<td colspan="2">

							<!-- Getting the id and the price as hidden type -->

							<input type="hidden" name="id" value="<?php echo $id; ?>">				
							<input type="hidden" name="price" value="<?php echo $price; ?>">
							
							<input type="submit" name="submit" value="Update Order" class="btn-secondary">

						</td>

					</tr>

				</table>

			</form>

			<?php

				// Checking if the update button was clicked or not! 

				if(isset($_POST['submit'])){

					//echo "Button Clicked Bitch!"; 

					// Now that it worked, it't time to get the data from the above form!

					$id = $_POST['id'];
					$price = $_POST['price'];
					$qty = $_POST['qty'];
					$total = $price * $qty;
					$status = $_POST['status'];
					$customer_name = $_POST['customer_name'];

					// Now query to update these values in the database! 

					$sql2 = "UPDATE tbl_order SET
						qty = $qty,
						total = $total,
						status = '$status',
						customer_name = '$customer_name'
						WHERE id = $id	
					";


					// Executing the query! 

					$res2 = mysqli_query($conn, $sql2); 

					// Now to check if it executed successfully or not! 

					if($res2 == true){

						// Successful!

						$_SESSION['update'] = "<div class='success'>Order Updated Successfully!</div>";

						// Now redirecting to management page after showing the message! 

						header('location:'.HOMEURL.'admin/order-management.php'); 

					} else {

						// Not Successful!

						$_SESSION['update'] = "<div class='error'>Failed To Update Order Successfully!</div>";

						// Now redirecting to management page after showing the message! 

						header('location:'.HOMEURL.'admin/order-management.php'); 

					}

				} 

			?>

	</div>
</div>






<?php 
	
	include('Reusables/footer.php');

?>