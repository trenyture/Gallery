<?php
	session_start();
	if (!file_exists('./secure.txt')) {
		require_once('./templates/newadmin.php');
	}else{
		if(!isset($_SESSION['admin'])){
			require_once('./templates/connexion.php');
		}else{
			if(isset($_GET['action'])){
				switch ($_GET['action']) {
					case 'logout':
						require_once('./functions/logout.php');
						break;
					case 'other_admin':
						require_once('./templates/otherAdmin.php');
						break;
					default:
						require_once('./templates/dashboard.php');
						break;
				}
			}else{
				require_once('./templates/dashboard.php');
			}
		}
	}
?>
