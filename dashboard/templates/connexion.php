<?php
	require_once('functions/connexion.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Administration - Connexion</title>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<script type="text/javascript" src="../assets/js/main.js"></script>
	</head>
	<body id="administration">
		<section id="connexion">
			<h1>Administration - Connexion</h1>
			<?php 
				if ($error === true) {echo '<ul id="error_msg">' . $message . '</ul>';} 
			?>
			<form method="POST">
				<div class="form-part">
					<label for="ident">Username or Email</label>
					<input type="text" name="ident" id="ident" value="<?php if (isset($_POST['ident'])){ echo $_POST['ident'];} ?>" required />
				</div>
				<div class="form-part">
					<label for="pass">Password</label>
					<input type="password" name="pass" id="pass" required />
				</div>
				<div class="submit">
					<a href="index.php?action=re_password">Password Lost</a>
					<button type="submit">Send</button>
				</div>
			</form>
		</section>
	</body>
</html>