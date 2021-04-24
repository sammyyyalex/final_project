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
			<h1 class="title">Login</h1>
           <?php if (isset($_GET['error'])){?>
               <p class="errorME"><?php echo $_GET['error']; ?></p>
                <?php } ?>
			<form action="loginFunctions.php" method="post">
				Username: <br>
				<input class="text" name="uname" type="text" id="userName" placeholder="  Username">
				<p >&nbsp;  </p>
				Password: <br>
				<input type="password" name="password" id="password" class="text"  placeholder="  Password">
				<p >&nbsp;  </p>

				<button type="submit" value="button" class="btn">Login</button>
				<a href="register.php" class="righttext">Do not have an account?</a>
			</form>
		</div>
	</body>
</html>