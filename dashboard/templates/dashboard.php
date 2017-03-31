<?php
	require_once('functions/dashboard.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<base href="http://localhost/galery/dashboard/">
		<meta charset="utf-8" />
		<title>Administration - Accueil</title>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<script type="text/javascript" src="../assets/js/main.js"></script>
	</head>
	<body id="administration">
		<section id="dashboard">
			<header>
				<h1>Bonjour <?= $_SESSION['admin'] ?></h1>
				<nav id="admin_actions">
					<ul>
						<li><a href="index.php?action=other_admin">Create new administrator</a></li>
						<li><a href="index.php?action=new_folder&folder=<?php echo $dir; ?>">Create new folder</a></li>
						<li><a href="index.php?action=upload">Upload Files</a></li>
						<li><a href="index.php?action=logout">Log Out</a></li>
					</ul>
				</nav>
			</header>
			<main>
				<?php
					if ($breadcrumb !== ''){
						echo "<p id='breadcrumb'>".$breadcrumb."</p>";
					}
					if ($directories !== '') {
						echo '<ul id="folders_list">'.$directories.'</ul>';
					}
					if ($message !== '') {
						echo '<ul id="files_list">'.$message.'</ul>';
					}
				?>
			</main>
		</section>
		<aside>
			<article>
				<h2></h2>
			</article>
		</aside>
		<footer>
			<p>Tous droits réservés - Simon Trichereau - 2017</p>
		</footer>
	</body>
</html>