<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src = "input_check.js"></script>
		<link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

	</head>
	<body>
		<div class="container">
			<h1 class="title">Register</h1>
           <?php if (isset($_GET['error'])){?>
               <p class="errorME"><?php echo $_GET['error']; ?></p>
                <?php } ?>

			<form action="registerFunctions.php" method="post">
				First name: <br>
				<input class="text" name="first" type="text" id="FirstName" placeholder=" First Name">
				<p >&nbsp;  </p>
				Last name: <br>
				<input type="text" name="last" id="LastName" class="text"  placeholder=" Last Name">
				<p >&nbsp;  </p>
				Email: <br>
				<input type="text" name="email" id="Email" class="text"  placeholder=" Email address">
				<p >&nbsp;  </p>
				Username: <br>
				<input type="text" name="uname" id="uname" class="text"  placeholder="Pick a username">
                <p >&nbsp;  </p>
                Password: <br>
				<input type="password" name="password" id="password" class="text"  placeholder="Pick a password">
				<p >&nbsp;  </p>
				<br>
				<button type="submit" value="button" class="btn">Register</button>
				<a href="index.php" class="righttext">Already have an account?</a>
			</form>
		</div>
	</body>
</html>