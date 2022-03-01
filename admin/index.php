<!DOCTYPE html>

<?php 

	include('Reusables/menu.php');

?>

	<!-- Main Content section starts -->

	<div class = "main-content"> 
		<div class = "wrapper">

			<h1>Dashboard</h1>
			
			<br> <br>

			<?php
				
				if(isset($_SESSION['login'])){         			// To display the login message that comes after succeding. 

				echo $_SESSION['login'];
				unset($_SESSION['login']);
				}

			?>

			<br> <br>

			<div class = "col-4 text-center">

				<?php

					$sql = "SELECT * FROM tbl_category";		// Getting info from the category table in the database!

					$res = mysqli_query($conn, $sql); 			// Executing the query! 

					$count = mysqli_num_rows($res); 			// Counting rows as always! And this will be the number of the categories! 


				?>

				<h1><?php echo $count; ?></h1>

				<br />

				Categories

			</div>

			<div class = "col-4 text-center">

				<?php

					$sql2 = "SELECT * FROM tbl_food";		// Getting info from the category table in the database!

					$res2 = mysqli_query($conn, $sql2); 			// Executing the query! 

					$count2 = mysqli_num_rows($res2); 			// Counting rows as always! And this will be the number of the categories! 


				?>


				<h1><?php echo $count2; ?></h1>

				<br />

				Foods

			</div>

			<div class = "col-4 text-center">

				<?php

					$sql3 = "SELECT * FROM tbl_order";		// Getting info from the category table in the database!

					$res3 = mysqli_query($conn, $sql3); 			// Executing the query! 

					$count3 = mysqli_num_rows($res3); 			// Counting rows as always! And this will be the number of the categories! 


				?>


				<h1><?php echo $count3; ?></h1>

				<br />

				Total Orders

			</div>

			<div class = "col-4 text-center">

				<?php

					// Query to get the total earnings! 
					// For this, will use the aggregate function in SQL!

					$sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Delivered'";

					// Because we will earn the money only if the order was delivered properly! 

					// Executing the query! 

					$res4 = mysqli_query($conn, $sql4);

					// Now to get the value! 

					$row = mysqli_fetch_assoc($res4); 

					// Get the Total! 

					$total_earnings = $row['Total'];		// ['Total'] not ['total']! Remember! 

				?>

				<h1>$<?php echo $total_earnings; ?></h1>

				<br />

				Earnings

			</div>

			<div class = "clearfix"></div>

		</div>

	</div>

	<!-- Main Content section ends -->

<?php 

	include('Reusables/footer.php');

?>