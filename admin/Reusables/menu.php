<?php
	include('../config/constants.php');
	include('login-check.php');				// Adding the authorization part in the menu file because everyone has menu included.
?>

<?php
	
	

?>

<html>
<head>
	<title>Food Order Website - Home Page</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css"> 
</head>
<body>
	<!-- Menu section starts -->
	<div class = "menu text-center">
		<div class = "wrapper">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="admin-management.php">Admin</a></li>
				<li><a href="category-management.php">Category</a></li>
				<li><a href="food-management.php">Food</a></li>
				<li><a href="order-management.php">Order</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
	<!-- Menu section ends -->

</body>
</html>