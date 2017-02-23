<?php
	$directories='';
	$message='';
	$backHome=false;
	if (isset($_GET['folder'])) {
		$dir = '/'.trim($_GET['folder']).'/';
		$backHome=true;
		$titlePage = explode('/', $_GET['folder']);
		$titlePage = end($titlePage);
	}else{
		$dir = '/';
		$titlePage="Accueil - Galerie Photo";
	}
	$files = scandir('./storage'.$dir);
	//affichage li foreach
	foreach ($files as $file) {
		if (!($file === '.' || $file === '..' || $file === '.htaccess')) {
			if (is_dir('./storage'.$dir.$file)==true) {
				$directories .= '<li><a href=".'.$dir.$file.'"><img src="http://simon-tr.com/photos/assets/img/folder.png" /><p>'.$file.'</p></a></li>';
			}else{
				$size = getimagesize('./storage'.$dir.$file);
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
				$message .= '<li data-orientation="'.$class.'" style="background-image:url(./miniatures'.$dir.$file.');"><a href="./storage'. $dir.$file .'" data-name="'.$title.'"></a></li>';
			}
		}
	}
?>