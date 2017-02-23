<?php 
	$directories='';
	$message='';
	$false='';
	$backHome=false;
	if (isset($_GET['folder'])) {
		$dir = './storage/'.$_GET['folder'].'/';
		$dirMin = './miniatures/'.$_GET['folder'].'/';
		$backHome=true;
		$titlePage=$_GET['folder'] . " - Galerie Photo";
	}else{
		$dir = './storage/';
		$dirMin = './miniatures/';
		$titlePage="Accueil - Galerie Photo";
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
					$size = getimagesize($dir.$file);
					if ($size[0] < $size[1]) {
						$class='portrait';
					}else{
						$class='paysage';
					}
					$title = explode('.',$file);
					if(sizeof($title) > 1){
						array_pop($title);
					}
					$title = implode('.',$title);
					$message .= '<li data-orientation="'.$class.'" style="background-image:url('.$dirMin.$file.');"><a href="'. $dir.$file .'" data-name="'.$title.'"></a></li>';
				}
				break;
		}
	}
?>