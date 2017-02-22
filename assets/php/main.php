<?php 
	$directories='';
	$message='';
	$false='';
	if (isset($_GET['folder'])) {
		$dir = './storage/'.$_GET['folder'].'/';
		$backHome="<a id='aback' href='/photos/'>Retour</a>";
		$titlePage=$_GET['folder'];
	}else{
		$dir = './storage/';
		$backHome='';
		$titlePage="Accueil";
	}
	$files = scandir($dir);
	//affichage li foreach
	foreach ($files as $file) {
		switch ($file) {
			case '.':
				$false = '';
				break;
			case '..':
				$false = '';
				break;
			case '.htaccess':
				$false = '';
				break;
			default:
				if (is_dir($dir.$file)==true) {
					$directories .= '<li><a href="./?folder='.$file.'"><img src="http://simon-tr.com/photos/assets/img/folder.png" /><p>'.$file.'</p></a></li>';
				}else{
					$message .= '<li><a href="#" class="avoir"><img src="'.$dir.$file.'" /></a></li>';
				}
				break;
		}
	}
?>