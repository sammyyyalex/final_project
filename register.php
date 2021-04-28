<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="./login/style.css">
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
			<form method="post" action="registerFunctions.php">
				<label for="first">First name:</label>
				<input type="text" class="text" name="first"  id="FirstName" placeholder=" First Name">
				<p >&nbsp;  </p>
				<label for="last">Last name:</label>
				<input type="text" class="text" name="last" id="LastName" placeholder=" Last Name">
				<p >&nbsp;  </p>
				<label for='email'>Email:</label>
				<input type="text" class="text" name="email" id="Email" placeholder=" Email address">
				<p >&nbsp;  </p>
				Username: <br>
				<input type="text" class="text" name="uname" id="uname" placeholder="Pick a username">
                <p >&nbsp;  </p>
                Password: <br>
				<input type="password" class="text" name="password" id="password" placeholder="Pick a password">
				<p >&nbsp;  </p>
				<br>
				<a href="db.php"><button type="submit" value="button" class="btn">Register</button></a>
				<a href="#" class="righttext">Already have an account?</a>
			</form>
		</div>
	</body>
</html>