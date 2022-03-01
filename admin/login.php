<?php

	include('../config/constants.php');

?>

<!DOCTYPE html>


<html>
<head>

	<title>Login</title>

	<link rel="stylesheet" type="text/css" href="..//css/admin.css">

</head>

<body>

	<div class="login">

		<h1 class="text-center">Login</h1>

		<br> <br>

		<?php

			if(isset($_SESSION['login'])){

				echo $_SESSION['login'];
				unset($_SESSION['login']);
			}

			if(isset($_SESSION['not_loggedin_message'])){

				echo $_SESSION['not_loggedin_message'];
				unset($_SESSION['not_loggedin_message']);
			}

		?>
		
		<br> <br>

		<form action="" method="POST" class="text-center">

			Username:

			<input type="text" name="username" placeholder="Enter Username"> 
			<br> <br>

			Password:

			<input type="password" name="password" placeholder="Enter Password"> 
			<br> <br>

			<input type="submit" name="submit" value="Login" class="btn-primary"> 
			<br> <br> <br>

		</form>

		<p class="text-center">Developed By - <a href="https://www.linkedin.com/in/md-ahsanul-hasan-saki">Saki</a></p>

	</div>

</body>

</html>


<?php

	// To Check whether the submit button was clicked or not.


	if(isset($_POST['submit'])){

		// $username = $_POST['username'];
		// $password = md5($_POST['password']);  					// Getting Data from the form when the submit is hit! 

		// We won't be getting those data directly because that could impose a threat to our site, servers and all the data! 

		// So we'll be using the mysqli_real_escape_string function. We've already used in the food-search.php first. 

		// See in that file on the food search bar section of the code. 

		// Though I haven't found any kinds of problems while testing it on the login. I did on the food search bar.

		// But still we'll use this method. Because it's better to Be Safe Than Sorry!


		$username = mysqli_real_escape_string($conn, $_POST['username']);

		$password = mysqli_real_escape_string($conn, md5($_POST['password']));

		// We wouldn't also need this method in the passwords field because it's already encrypted but there'ss no harm in adding it! 

		// We can also use this method in all the other fields where we take text input like add-admin or update-food etc.

		// But those are only accessible by the admins. And not everyone. 

		// So we can add this to those as well but for now we won't be doing it! Because it won't be a threat!


		// SQL Query to check the data from the databse. 

		$sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

		$res = mysqli_query($conn, $sql);							// Executing the SQL Query. 

		$count = mysqli_num_rows($res); 							// Checking whether we got the user or not. 

		if($count == 1){

			// User Available. Login success. 

			$_SESSION['login'] = "<div class = 'success'> Login Successful! </div>";								// Successful message.
			
			$_SESSION['user'] = $username;  	// To check whether the user is logged in or not. Only logout can unset it. 

			// This user session is only set when the login is a success. 	

			header('location:'.HOMEURL.'admin/');

		} else {
			// User Not Available. Login Failed. 

			$_SESSION['login'] = "<div class = 'error text-center'> Username or Password not matched! </div>";			// Failed message. 
			header('location:'.HOMEURL.'admin/login.php');

		}

	}
	

?>