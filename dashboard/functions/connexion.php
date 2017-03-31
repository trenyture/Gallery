<?php
	$error = false;
	$message = '';
	if(isset($_POST['ident']) && isset($_POST['pass'])) {
		$pseudo = htmlspecialchars($_POST['ident']);
		$pass = htmlspecialchars($_POST['pass']);
		if (empty($pseudo) || $pseudo === '') {
			$error = true;
			$message .= '<li>You have to write an Username!</li>';
		}
		if (empty($pass) || $pass === '') {
			$error = true;
			$message .= '<li>You have to write a Password</li>';
		}
		if ($error === false) {
			$json_data = file_get_contents('secure.txt');
			$datas = json_decode($json_data, true);
			$found = false;
			$identified = false;
			foreach ($datas as $data) {
				if (strtolower($data['pseudo']) === strtolower($pseudo) || strtolower($data['mail']) === strtolower($pseudo)) {
					$found = true;
					if(crypt($pass, $data['pseudo']) === $data['pass']){
						$identified = true;
					}
				}
			}
			if ($found === true) {
				if ($identified === true) {
					$_SESSION['admin'] = $pseudo;
					header('location:index.php');
				}else{
					$error = true;
					$message .= '<li>The password is incorrect</li>';	
				}
			}else{
				$error = true;
				$message .= '<li>The identifiant is incorrect</li>';
			}
		}
	}
?>