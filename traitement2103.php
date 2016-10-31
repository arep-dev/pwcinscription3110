<?php 
	session_start();

	define('USER', 'arep_CATB');
	define('HOST', '142.4.214.101');
	define('PASSWORD', 'arep-sa');
	define('DATABASE', 'PWC');

	if(isset($_POST['login']) && $_POST['login'] == 'ok') {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$bdd = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);

		$sql = 'SELECT ID, PASSWORD FROM PROFIL WHERE EMAIL = "'.$email.'"';
		/*$requete = $bdd->prepare($sql);
		$check = $requete->execute(array(
			$email
		));*/
		$check = $bdd->query($sql);
		$result = $check->fetch();

		if($password == $result['PASSWORD']) {
			$_SESSION['id'] = $result['ID'];
			echo 'loginTrue';
		}else{
			echo 'loginFalse';
		}
	}else{

		$id = $_POST['id'];
		$civilite = $_POST['civilite'];
		$participation = htmlspecialchars($_POST['participation']);
		$hebergement = htmlspecialchars($_POST['hebergement']);
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$numero = htmlspecialchars($_POST['numero']);
		$email = htmlspecialchars($_POST['email']);
		$commentaire = htmlspecialchars($_POST['commentaire']);
		$fonction = htmlspecialchars($_POST['fonction']);
		$bu = htmlspecialchars($_POST['bu']);
		$acc = htmlspecialchars($_POST['acc']);
		$room = htmlspecialchars($_POST['room']);

		if(!isset($_POST['participation-diner'])) {
			$participationDiner = 'non';
			$participationnom = 'Je ne participerai pas';
		}else{
			$participationDiner = 'oui';
			$participationnom = 'Je participerai';
		}

		if(!isset($_POST['participation-team'])) {
			$participationTeam = 'non';
		}else{
			$participationTeam = 'oui';
		}

		if($civilite == "m") {
			$civilite = "M.";
		}else if($civilite == "mme") {
			$civilite = "Mme";
		}


	if($hebergement != "non") {
			if($acc != "") {
			$mailAcc = "<li>Je souhaite partager ma chambre avec : ".$acc.".</li>";
		}else{
			if($room!= "") {
			   $mailAcc = "<li>Partage de chambre : je laisse le hasard faire les choses.</li>";
		      }
			  else{
              $mailAcc ="";
		}
		}
       }
        // FABRICE SUDAKA
		// A REMETTRE LORS DU PASSAGE EN PRODUCTION POUR VERROUILLER LE FORMULAIRE UNE FOSI QU'IL A ETE ENVOYE
		//$checkform = 1;
		
		// Connexion à la base de donnée
		$bdd = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);
		$bdd->exec("SET CHARACTER SET utf8");
		$sql = 'UPDATE PROFIL SET CIVILITE = ?, NOM = ?, PRENOM = ?, FONCTION = ?,  BU = ?, NUMERO = ?, EMAIL = ?, PARTICIPATION = ?, PARTICIPATION_TEAM = ?, PARTICIPATION_DINER = ?, HEBERGEMENT = ?, ACC = ?, COMMENTAIRE = ?, CHECKFORM = ? WHERE id = ?';
		$requete = $bdd->prepare($sql);
		$check = $requete->execute(array(
			$civilite,
			$nom,
			$prenom,
			$fonction,
			$bu,
			$numero,
			$email,
			$participation,
			$participationTeam,
			$participationDiner,
			$hebergement,
			$acc,
			$commentaire,
			$checkform,
			$id
		));

		if($hebergement == '') {
			$hebergement = 'non';
		}

		if($email != '') {
			require 'PHPMailer-master/PHPMailerAutoload.php';

			$mail = new PHPMailer;
			$mail->CharSet = "UTF-8";
			$mail->setFrom('no-reply@arep.co.com', 'PwC');
			$mail->addAddress($email, $nom.' '.$prenom);    

			$mail->isHTML(true);          

			$mail->Subject = 'Inscription "Staff Day Consulting & Strategy"';
			$mail->Body    = '<img src="http://challenge-pro.fr/pwc/img/logo.gif"><br><br>
			Bonjour '.$prenom.', <br> Nous vous confirmons que vos choix ont bien été pris en compte.<br>
			Voici un récapitulatif : <br>
			<ul>
			<li>E-mail : '.$email.'</li>
			<li>Numéro de téléphone : '.$numero.'</li>
			<li>Grade : '.$fonction.'</li>
			<li>BU : '.$bu.'</li>
			<li>Confirmation de votre présence : '.$participationnom.'</li>
			<li>Participation à l\'activité Rallye : '.$participationTeam.'</li>
			<li>Participation à la soirée paquebot : '.$participationDiner.'</li>
			<li>Demande d\'hébergement : '.$hebergement.'</li>
			'.$mailAcc.'
			<li>Vos commentaires : '.$commentaire.'</li>
			</ul>
			<br><br>
			Pour tout changement, veuillez contacter Léonard Blanvillain par téléphone au 01.85.74.00.41 ou par e-mail à l\'adresse suivante : l.blanvillain@arep.co.com';

			if(!$mail->send()) {
			  	echo 'false';
			} 	
		}
		
		if($check) {
			echo 'true';
		}else{
			echo 'false';
		}

	}
?>