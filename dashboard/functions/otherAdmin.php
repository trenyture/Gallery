<?php
	$error = false;
	$message = '';
	if(isset($_POST['adminName']) && isset($_POST['adminPwd']) && isset($_POST['newAdminName']) && isset($_POST['newAdminMail']) && isset($_POST['verifNewAdminMail']) && isset($_POST['newAdminPwd']) && isset($_POST['verifNewAdminPwd'])) {
		$adminPseudo = htmlspecialchars($_POST['adminName']);
		$adminPass = htmlspecialchars($_POST['adminPwd']);
		$nAdminPseudo = htmlspecialchars($_POST['newAdminName']);
		$nAdminMail = htmlspecialchars($_POST['newAdminMail']);
		$nAdminMailTwo = htmlspecialchars($_POST['verifNewAdminMail']);
		$nAdminPwd = htmlspecialchars($_POST['newAdminPwd']);
		$nAdminPwdTwo = htmlspecialchars($_POST['verifNewAdminPwd']);

		if (empty($adminPseudo) || $adminPseudo === '') {
			$error = true;
			$message .= '<li>You have to write your admin Name!</li>';
		}
		if (empty($adminPass) || $adminPass === '') {
			$error = true;
			$message .= '<li>You have to write a Password</li>';
		}
		if ($error === false) {
			$json_data = file_get_contents('secure.txt');
			$datas = json_decode($json_data, true);
			$found = false;
			$identified = false;
			foreach ($datas as $data) {
				if (strtolower($data['pseudo']) === strtolower($adminPseudo) || strtolower($data['mail']) === strtolower($adminPseudo)) {
					$found = true;
					if(crypt($adminPass, $data['pseudo']) === $data['pass']){
						$identified = true;
					}
				}
			}
			if ($found === true) {
				if ($identified !== true) {
					$error = true;
					$message .= '<li>The password is incorrect</li>';	
				}else{
					if (empty($nAdminPseudo) || $nAdminPseudo === '') {
						$error = true;
						$message .= '<li>You have to write a new admin Name!</li>';
					}
					if (empty($nAdminMail) || $nAdminMail === '') {
						$error = true;
						$message .= '<li>You have to write an admin email!</li>';
					}else{
						if (filter_var($nAdminMail, FILTER_VALIDATE_EMAIL) === false) {
							$error = true;
							$message .= '<li>You have to write a <b>valid</b> admin email!</li>';
						}else{
							if($nAdminMail !== $nAdminMailTwo){
								$error = true;
								$message .= '<li>You had written two different emails!</li>';
							}
						}
					}
					if (empty($nAdminPwd) || $nAdminPwd === '') {
						$error = true;
						$message .= '<li>You have to write an admin password!</li>';
					}else{
						if($nAdminPwd !== $nAdminPwdTwo){
							$error = true;
							$message .= '<li>You had written two different Passwords!</li>';	
						}
					}
					if ($error === false) {
						$json_data = file_get_contents('secure.txt');
						$datas = json_decode($json_data, true);
						$founded = false;
						foreach ($datas as $data) {
							if (strtolower($data['pseudo']) === strtolower($nAdminPseudo) || strtolower($data['mail']) === strtolower($nAdminMail)) {
								$founded = true;
							}
						}
						if ($founded === true) {
							$error = true;
							$message .= '<li>An Admin with this Username already exists</li>';
						}else{
							$result = array(
								'pseudo' => $nAdminPseudo,
								'mail' => $nAdminMail,
								'pass' => crypt($nAdminPwd, $nAdminPseudo)
							);
							$myfile = fopen("secure.txt", "w") or die("Unable to open file!");
							$json_data = ltrim($json_data, '[');
							$json_data = rtrim($json_data, ']');
							$result = json_encode($result);
							$result = $json_data . ',' . $result;
							fwrite($myfile, '['.$result.']');
							fclose($myfile);
							header('location:index.php');
						}
					}
				}
			}else{
				$error = true;
				$message .= '<li>The identifiant is incorrect</li>';
			}
		}
		if ($error === false) {

		}
	}
?>