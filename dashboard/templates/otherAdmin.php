<?php
	require_once('functions/otherAdmin.php');
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
		<section id="otheradmin">
			<h1>Administration - New Admin</h1>
			<?php 
				if ($error === true) {echo '<ul id="error_msg">' . $message . '</ul>';} 
			?>
			<form method="POST">
				<div class="form-part">
					<label for="adminName">Your Admin Name</label>
					<input type="text" name="adminName" id="adminName" required />
				</div>
				<div class="form-part">
					<label for="adminPwd">Your Admin Password</label>
					<input type="password" name="adminPwd" id="adminPwd" required />
				</div>
				<div class="form-part">
					<p>New Administrator : </p>
				</div>
				<div class="form-part">
					<label for="newAdminName">New Admin Name</label>
					<input type="text" name="newAdminName" id="newAdminName" value="<?php if (isset($_POST['newAdminName'])){ echo $_POST['newAdminName'];} ?>" required />
				</div>
				<div class="form-part">
					<label for="newAdminMail">New Admin Mail</label>
					<input type="email" name="newAdminMail" id="newAdminMail" value="<?php if (isset($_POST['newAdminMail'])){ echo $_POST['newAdminMail'];} ?>" required />
				</div>
				<div class="form-part">
					<label for="verifNewAdminMail">Repeat New Admin Mail</label>
					<input type="email" name="verifNewAdminMail" id="verifNewAdminMail" required />
				</div>
				<div class="form-part">
					<label for="newAdminPwd">New Admin Password</label>
					<input type="password" name="newAdminPwd" id="newAdminPwd" required />
				</div>
				<div class="form-part">
					<label for="verifNewAdminPwd">Repeat New Admin Password</label>
					<input type="password" name="verifNewAdminPwd" id="verifNewAdminPwd" required />
				</div>
				<div class="submit">
					<button type="submit">Send</button>
				</div>
			</form>
		</section>
	</body>
</html>