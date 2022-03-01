<?php 
	
	include('Reusables/menu.php');

?>

<div class = "main-content"> 
	<div class = "wrapper">
		<h1>Manage Order</h1>
			
			<br /> <br /> <br />


			<?php


				// This php portion here is used to display the messages from updating the orders!

				if(isset($_SESSION['update'])){

					echo $_SESSION['update'];
					unset($_SESSION['update']);

				}


			?>

			<br><br>


			<table class = "tbl-full">
				<tr>
					<th>Serial Number</th>
					<th>Food</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Total</th>
					<th>Order Date</th>
					<th>Status</th>
					<th>Customer Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Address</th>
					<th>Actions</th>
				</tr>

				<?php

					$sn = 1; 		// Creating the serial number variable! 


					// Get the order details from the database! 

					$sql = "SELECT * FROM tbl_order ORDER BY id DESC";						// DESC used to show the latest orders first!  

					// Executing the above query!

					$res = mysqli_query($conn, $sql);

					// Counting the rows! 

					$count = mysqli_num_rows($res);

					if($count > 0){

						// Data Available!

						while($row = mysqli_fetch_assoc($res)){

							// Get the Data!

							$id = $row['id'];
							$food = $row['food'];
							$price = $row['price'];
							$qty = $row['qty'];
							$total = $row['total'];
							$order_date = $row['order_date'];
							$status = $row['status'];
							$customer_name = $row['customer_name'];
							$customer_contact = $row['customer_contact'];
							$customer_email = $row['customer_email'];
							$customer_address = $row['customer_address'];

							// Closing the php to display all these data in our table!

							?>

								<tr>
									<td><?php echo $sn++; ?>.</td>
									<td><?php echo $food; ?></td>
									<td><?php echo $price; ?></td>
									<td><?php echo $qty; ?></td>
									<td><?php echo $total; ?></td>
									<td><?php echo $order_date; ?></td>


									<td>

										<?php

											if($status == "Ordered"){

												echo "<label style='color: purple;'>$status</label>"; 		// Just plain black! 

												//Not just plain black anymore though! Now it's purple! 
												

											} elseif($status == "On The Way"){

												echo "<label style='color: orange;'>$status</label>";

											} elseif($status == "Delivered"){

												echo "<label style='color: green;'>$status</label>";
												
											} elseif($status == "Cancelled"){

												echo "<label style='color: red;'>$status</label>";
												
											}

										?>
											
									
									</td>


									<td><?php echo $customer_name; ?></td>
									<td><?php echo $customer_contact; ?></td>
									<td><?php echo $customer_email; ?></td>
									<td><?php echo $customer_address; ?></td>
									<td>
										<a href="<?php echo HOMEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">UpdateOrder</a>
										
									</td>

								</tr>

							<?php

						}

					} else {

						// Data Not Available!

						echo "<tr><td colspan='12' class='error'>No Orders Available!</td></tr>";

					}

				?>

				

				
			</table>

	</div>

</div>


<?php 
	
	include('Reusables/footer.php');

?>