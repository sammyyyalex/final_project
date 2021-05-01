<!DOCTYPE html>
<html>
	<head>
		<title>Change Username</title>
		<link rel="stylesheet" type="text/css" href="./login/style.css">
		<script src = "input_check.js"></script>
		<link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

	</head>
	<body>
		<div class="container">
			<h1 class="title">Change Username</h1>
			<?php if (isset($_GET['error'])){?>
                           <p class="errorME"><?php echo $_GET['error']; ?></p>
                            <?php } ?>
			<form method="post" action="changeUsernameFunctions.php">
				Current Username: <br>
				<input type="text" class="text" name="currentUname" id="currentUname" placeholder="Current username">
                <p >&nbsp;  </p>
                New Username: <br>
				<input type="text" class="text" name="newUname" id="newUname" placeholder="New username">
				<p >&nbsp;  </p>
				<br>
				Password: <br>
				<input type="password" class="text" name="password" id="password" placeholder="password">
				<p >&nbsp;  </p>
				<br>
				<a href="db.php"><button type="submit" value="button" class="btn">Change username</button></a>
				<a href="userAccount.php" class="righttext">Back</a>
			</form>
		</div>
	</body>
</html>