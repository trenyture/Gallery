<?php
	require_once('functions/newadmin.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Create a new Administrator</title>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<script type="text/javascript" src="../assets/js/main.js"></script>
	</head>
	<body id="administration">
		<section id="newadmin">
			<h1>Create a new Administrator</h1>
			<?php 
				if ($error === true) {echo '<ul id="error_msg">' . $message . '</ul>';} 
			?>
			<form method="POST">
				<div class="form-part">
					<label for="pseudo">Your Username</label>
					<input type="text" name="pseudo" id="pseudo" value="<?php if (isset($_POST['pseudo'])){ echo $_POST['pseudo'];} ?>" required />
				</div>
				<div class="form-part">
					<label for="mail">Your Mail</label>
					<input type="email" name="mail" id="mail" value="<?php if (isset($_POST['mail'])){ echo $_POST['mail'];} ?>" required />
				</div>
				<div class="form-part">
					<label for="mail_two">Repeat Your Mail</label>
					<input type="email" name="mail_two" id="mail_two" required />
				</div>
				<div class="form-part">
					<label for="pass">Your Password</label>
					<input type="password" name="pass" id="pass" required />
				</div>
				<div class="form-part">
					<label for="pass_two">Repeat Your Password</label>
					<input type="password" name="pass_two" id="pass_two" required />
				</div>
				<div class="submit">
					<button type="submit">Send</button>
				</div>
			</form>
		</section>
	</body>
</html>