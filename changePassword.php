<!DOCTYPE html>
<html>
	<head>
		<title>Change Password</title>
		<link rel="stylesheet" type="text/css" href="./login/style.css">
		<script src = "input_check.js"></script>
		<link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

	</head>
	<body>
		<div class="container">
			<h1 class="title">Change Password</h1>
			<?php if (isset($_GET['error'])){?>
                           <p class="errorME"><?php echo $_GET['error']; ?></p>
                            <?php } ?>
			<form method="post" action="changePasswordFunctions.php">
				Username: <br>
				<input type="text" class="text" name="uname" id="uname" placeholder="Current username">
                <p >&nbsp;  </p>
                New Password: <br>
				<input type="password" class="text" name="newPassword" id="newPassword" placeholder="Pick a new password">
				<p >&nbsp;  </p>
				<br>
				Current Password: <br>
				<input type="password" class="text" name="currentPassword" id="currentPassword" placeholder="Current password">
				<p >&nbsp;  </p>
				<br>
				<a href="db.php"><button type="submit" value="button" class="btn">Change password</button></a>
				<a href="userAccount.php" class="righttext">Back</a>
			</form>
		</div>
	</body>
</html>