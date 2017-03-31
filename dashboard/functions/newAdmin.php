<?php
	$error = false;
	$message = '';
	if(isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['pass'])) {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail_two = htmlspecialchars($_POST['mail_two']);
		$pass = htmlspecialchars($_POST['pass']);
		$pass_two = htmlspecialchars($_POST['pass_two']);
		//PSEUDO
		if (empty($pseudo) || $pseudo === '') {
			$error = true;
			$message .= '<li>You have to write an Username!</li>';
		}
		//MAIL
		if (empty($mail) || $mail === '') {
			$error = true;
			$message .= '<li>You have to write an email!</li>';
		}else{
			if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
				$error = true;
				$message .= '<li>You have to write a <b>valid</b> email!</li>';
			}else{
				if($mail !== $mail_two){
					$error = true;
					$message .= '<li>You had written two different emails!</li>';
				}
			}
		}
		//PASSWORD
		if (empty($pass) || $pass === '') {
			$error = true;
			$message .= '<li>You have to write a Password</li>';
		}else{
			if($pass !== $pass_two){
				$error = true;
				$message .= '<li>You had written two different Passwords!</li>';	
			}
		}

		//CREATE FILE
		if($error === false){
			$result = array(
				'pseudo' => $pseudo,
				'mail' => $mail,
				'pass' => crypt($pass, $pseudo)
			);
			$result = json_encode($result);
			$myfile = fopen("secure.txt", "w") or die("Unable to open file!");
			fwrite($myfile, '['.$result.']');
			fclose($myfile);
			header('location:index.php');
		}
	}
?>