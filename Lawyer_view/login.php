<?php 
include '../Database/db.php';
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Account Login</title>
	<!-- Load Icon -->
<link rel="icon" type="image/png" href="../users/user_logo.png">

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->	
<style type="text/css">
	body{
  background-color: white;
  background-size: cover;
}
</style>
</head>
<body>
	<!-- Loader Class Using div -->
<?php include 'loader.php';?>
<!-- End Loader -->

	<div class="container">	
	<div class="row h-75 justify-content-center align-items-center">
				<form method="POST" action="">
				<br/><br/>
						<h3 class="text-center text-dark">Legal Market Place</h3>
					<br/>
					<img src="../logo/my_logo.png" width="200px" height="150" style="margin-left: 50px;">
					
					<div class="form-group">
						<label class="text-dark">E-mail Address</label>
						<input class="form-control" type="text" name="email" placeholder="Enter Email" style="width: 330px;">
					</div>
					<div class="form-group">
						<label class="text-dark">Password</label>
						<input class="form-control" type="password" name="password" id="myInput" placeholder="Enter Password" style="width: 330px;">	
					</div>
					<p class="text text-danger" style="margin-left: 30px;">
						<?php
		if (isset($_POST['signin'])) {
			// getting users
			$user = $_POST['email'];
			$password = md5($_POST['password']);
		// Query
		$query = "SELECT * FROM Lawyer WHERE email = '$user' AND  password = '$password'";
		$execute = mysqli_query($link,$query) or die(mysqli_error($link));
		$result = mysqli_fetch_array($execute);
		 //check the result by counting the rows
		if ($password != $result['password'] && $user != $result['email'] ) {
		  	echo "Please provide valid Credentials .";
		  }else{
			 //check the result by counting the rows
			$num = mysqli_num_rows($execute);
			 if ($num != 0) {
		    $_SESSION['lawyerid'] = $result['lawyer_id'];
		    // Getting time count after login
		    $_SESSION['last_activity_timestamp'] = time(); 
		  header("location: lawyer_home.php");

		  }
		}
	}
?>
						
					</p>

					<!-- Visibility Password -->
					<input type="checkbox" onclick="visibility()" class="mb-3"> Show Password

					<div class="form-group">
						<button class="btn btn-danger" name="signin" style="width: 330px;padding: 10px;margin-left: 0px;">
							SIGN IN
						</button>
					</div>

					<ul style="margin-top: 0px;">
						<li class="list-group" class="text-white">
							<a href="reset_password.php" >
								Forgot Password?
							</a>
						</li>

						<li class="list-group">		
						<span class="text-primary">Don’t have an account? <a href="../lawyer_signup.php"> Sign up Now</a></span>
						</li>
					</ul>
				</form>
				</div>
		</div>

		<script>
			function visibility(){
				var x = document.getElementById("myInput");
				if (x.type === "password") {
					x.type = "text";
				}else{
					x.type = "password";
				}
			}
		</script>
</body>
</html>