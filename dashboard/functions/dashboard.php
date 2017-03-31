<?php
	$titlePage="Accueil - Galerie Photo";
	$directories='';
	$message='';
	$dir = '';
	$breadcrumb = '';
	if (isset($_GET['folder'])) {
		$dir = trim($_GET['folder']).'/';
		$allSegments = array_filter(explode('/', $_GET['folder']));
		$titlePage = end($allSegments);
		$src = '';
		$breadcrumb='<a href="'.$src.'">Home</a><span> / </span>';
		for ($i=0; $i < sizeof($allSegments); $i++) { 
			$src .= $allSegments[$i] . '/';
			if ($i + 1  === sizeof($allSegments)){
				$breadcrumb .= '<span class="final">'.$allSegments[$i].'</span>';
			}else{
				$breadcrumb .= '<a href="?folder='.$src.'">'.$allSegments[$i].'</a><span> / </span>';
			}
		}
	}
	$files = scandir('../storage/'.$dir);
	//affichage li foreach
	foreach ($files as $file) {
		if (!($file === '.' || $file === '..' || $file === '.htaccess')) {
			if (is_dir('../storage/'.$dir.$file)==true) {
				$directories .= '<li><a href="?folder='.$dir.$file.'"><img src="../assets/img/fold_placeholder.png" /><p>'.$file.'</p></a></li>';
			}else{
				$theFile = '../storage/'.$dir.$file;
				$type = mime_content_type($theFile);
				$type = explode('/', $type);
				$class=$type[0];
				$type = implode('/',$type);
				$title = explode('.',$file);
				if(sizeof($title) > 1){
					array_pop($title);
				}
				$title = implode('.',$title);
				if ($class === 'image') {
					$size = getimagesize($theFile);
					if ($size[0] < $size[1]) {
						$ort='portrait';
					}else{
						$ort='paysage';
					}
					$message .= '<li class="'.$class.'" data-type="'.$class.'" data-name="'.$title.'" data-orientation="'.$ort.'" style="background-image:url(../miniatures/'.$dir.$file.');"><a href="'.$dir.$file.'"></a></li>';
				}else{
					echo shell_exec("ffmpeg -i ".$theFile);
					$message .= '<li class="'.$class.'" data-type="'.$type.'" data-name="'.$title.'" data-orientation="'.$ort.'"><a href="'.$dir.$file.'"></a></li>';
				}
			}
		}
	}
?>