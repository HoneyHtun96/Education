<?php
session_start();
include 'function.php';
include 'dbconfig.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		$email =$_POST['email'];
		$password= $_POST['password'];
		$table = 'admins';

		if ($admin = login($email,$password,$table,$connection)) {
			$_SESSION['user_id'] = $admin['id'];
			$_SESSION['email'] = $admin['email'];
			$_SESSION['name'] = $admin['username'];
			$_SESSION['loggedin_time'] = time();
		}else{
			$message = "Invalid user email and password!";
		}
		
		/*echo $_SESSION['loggedin_time'];
		die();*/
	}

	if (isset($_SESSION['user_id'])) {
		if (!isLoginSessionExpired()) {
			header("Location:index.php");
		}else{
			header("Location:logout.php?session_on_expired=1");
		}
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<div class="col-md-4 offset-4 " id="form_box">

		<?php 
			if (isset($message)) { ?>
				
			<div class="form-group">
				<div class="alert alert-danger" role="alert">
				<?php echo $message; ?>
				</div>
			</div>

		<?php	
			}
		?>
		<form action="" method="post">
			<div class="form-group">
				<label>Email Address</label>
				<input type="text" name="email" class="form-control" placeholder="Enter email">
			</div>
			<p>We'll never share your email with anyone else.</p>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" placeholder="Password">
			</div>
			<div class="form-group">
				<input type="checkbox" name=""> Check me out
			</div>
			<div class="form-group">
				<input type="submit" value="LOGIN" class="btn btn-success" >
			</div>
		</form>
	</div>

</body>
</html>