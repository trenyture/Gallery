<?php
	require_once('assets/php/main.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $titlePage; ?> - Galerie Photo</title>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css" />
		<link rel="stylesheet" href="/assets/css/main.css" />
		<script type="text/javascript" src="/assets/js/main.js"></script>
	</head>
	<body>
		<header>
			<h1><?php echo $titlePage; ?></h1>
		</header>
		<main>
			<?php
				if ($backHome === true) {
					echo "<a href='/'>Retour à l'accueil</a>";
				}
				if ($directories !== '') {
					echo '<ul id="folders_list">'.$directories.'</ul>';
				}
				if ($message !== '') {
					echo '<ul id="files_list">'.$message.'</ul>';
				}
			?>
		</main>
		<aside>
			<article>
				<h2>Test</h2>
				<img src="" alt="" />
			</article>
		</aside>
		<footer>
			<p>Tous droits réservés - Simon Trichereau - 2017</p>
		</footer>
	</body>
</html>