<?php 
	session_start();

	define('USER', 'root');
	define('HOST', 'localhost');
	define('PASSWORD', 'root');
	define('DATABASE', 'PWC_INSCRIPTION');
	
	if(isset($_POST['login']) && $_POST['login'] == 'ok') {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$bdd = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);

		$sql = 'SELECT id, password FROM INSCRIPTIONS WHERE email = "'.$email.'"';
		/*$requete = $bdd->prepare($sql);
		$check = $requete->execute(array(
			$email
		));*/
		$check = $bdd->query($sql);
		$result = $check->fetch();

		if($password == $result['password']) {
			$_SESSION['id'] = $result['id'];
			echo 'loginTrue';
		}else{
			echo 'loginFalse';
		}
	}else{



		$participation = htmlspecialchars($_POST['participation']);
		$raison = htmlspecialchars($_POST['raison']);
		$date = htmlspecialchars($_POST['date']);
		$represente = htmlspecialchars($_POST['represente']);
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']);
		$site = htmlspecialchars($_POST['site']);
		$entite = htmlspecialchars($_POST['entite']);
		$email = htmlspecialchars($_POST['email']);
		$fonction = htmlspecialchars($_POST['fonction']);
		$telephone = htmlspecialchars($_POST['telephone']);
		$nomacc = htmlspecialchars($_POST['nomacc']);
		$prenomacc = htmlspecialchars($_POST['prenomacc']);
		$emailacc = htmlspecialchars($_POST['emailacc']);
		$organisation = htmlspecialchars($_POST['organisation']);
		$nbEvent = htmlspecialchars($_POST['nb-event']);
		$periodes = implode(', ', $_POST['periode']);
		$type = implode(', ', $_POST['type-event']);
		$type .= ', '.$_POST['autre'];
		$effectif = $_POST['effectif'];
		$checkform = "1";
		
		// Connexion à la base de donnée
		$bdd = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);
		$bdd->exec("SET CHARACTER SET utf8");


		// Check places restantes

		if($date != "") {
			switch($date) {
				case 'date1':
					$date = "Lundi 7 novembre 2016";
					$checkDate = 'DATE1';
					break;
				case 'date2':
					$date = "Mardi 8 novembre 2016";
					$checkDate = 'DATE2';
					break;	
				case 'date3':
					$date = "Lundi 7 novembre 2016 - Liste d'attente";
					$checkDate = 'DATE3';
					break;	
				case 'date4':
					$date = "Mardi 8 novembre 2016 - Liste d'attente";
					$checkDate = 'DATE3';
					break;	
				case 'date5':
					$date = "Je ne pourrai pas être disponible et souhaite être recontacté(e)";
					$checkDate = 'DATE3';
					break;	
			}
		}


		$sql = 'SELECT '.$checkDate.' FROM PLACES';
		$exec = $bdd->query($sql);
		$places = $exec->fetch();

		if($places[0] == 0) {
			echo 'placesFalse';
			die();
		}else{
			$places[0]--;
			$sql = 'UPDATE PLACES SET '.$checkDate.' = '.$places[0].' ';
			$bdd->exec($sql);
		}

		// Debug field
		/*echo $participation.'<br>';
		echo $raison.'<br>';
		echo $date.'<br>';
		echo $nom.'<br>';
		echo $prenom.'<br>';
		echo $site.'<br>';
		echo $entite.'<br>';
		echo $email.'<br>';
		echo $fonction.'<br>';
		echo $telephone.'<br>';
		echo $organisation.'<br>';
		echo $nbEvent.'<br>';
		echo $periodes.'<br>';
		echo $type.'<br>';*/
		
	
		// Connexion à la base de donnée
		$bdd = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);
		$bdd->exec("SET CHARACTER SET utf8");
		$sql = 'UPDATE INSCRIPTIONS SET participation = ?, raison = ?, date_choisie = ?, represente = ?, nom = ?, prenom = ?, site = ?, entite = ?, fonction = ?, email = ?, telephone = ?, nomacc = ?, prenomacc = ?, emailacc = ?, organisation = ?, nbevent = ?, effectif = ?, periodes = ?, type = ?, checkform = ? WHERE id = "'.$_SESSION['id'].'"';
		$requete = $bdd->prepare($sql);
		$check = $requete->execute(array(
			$participation,
			$raison,
			$date,
			$represente,
			$nom,
			$prenom,
			$site,
			$entite,
			$fonction,
			$email,
			$telephone,
			$nomacc,
			$prenomacc,
			$emailacc,
			$organisation,
			$nbEvent,
			$effectif,
			$periodes,
			$type,
			$checkform
		)) or die(print_r($requete->errorInfo(), TRUE));

 

// Envoi de mail si besoin


		if($email != '') {
			require 'PHPMailer-master/PHPMailerAutoload.php';

			$mail = new PHPMailer;
			$mail->CharSet = "UTF-8";
			$mail->setFrom('noreply@arep.co.com', 'PwC');
			$mail->addAddress($email, $nom.' '.$prenom);    

			$mail->isHTML(true);          

			$mail->Subject = 'Rencontres PwC-AREP';
			
					
				if ($organisation == "oui"){
				
				$mail->Body    = '<img src="http://challenge-pro.fr/pwc-inscription/img/header-mail.jpg"><br><br>
				Bonjour '.$prenom.', <br>Votre réponse a bien été prise en compte.<br>
				<br>
				
				
				<strong>Votre choix : </strong>'.$date.'<br>
				
				<ul>
				<li><strong>Nom : </strong> '.$nom.'</li>
				<li><strong>Prénom : </strong> '.$prenom.'</li>
				<li><strong>Site : </strong> '.$site.'</li>
				<li><strong>Entité : </strong> '.$entite.'</li>
				<li><strong>Fonction : </strong> '.$fonction.'</li>
				<li><strong>E-mail : </strong> '.$email.'</li>
				<li><strong>Téléphone : </strong> '.$telephone.'</li>
				</ul>
				
				<strong>Je serai accompagné de : </strong><br>
				
				<ul>
				<li><strong>Nom : </strong> '.$nomacc.'</li>
				<li><strong>Prénom : </strong> '.$prenomacc.'</li>
				<li><strong>E-mail : </strong> '.$emailacc.'</li>
				</ul>
				
				<strong>Je suis amené(e) à organiser des événements : </strong>'.$organisation.'<br>
				
				
				<ul>
				<li><strong>J\'organise des  : </strong> '.$type.'</li>
				<li><strong>Nombre d\'événements organisés par an : </strong> '.$nbEvent.'</li>
				<li><strong>Effectif moyen : </strong> '.$effectif.'</li>
				<li><strong>Périodes  : </strong> '.$periodes.'</li>
				</ul>
				
				
				Pour toute information contacter : Catherine Prieur au 01 85 74 00 77 ou c.prieur@arep.co.com<br><br>';
				
				}else{
				
				$mail->Body    = '<img src="http://challenge-pro.fr/pwc-inscription/img/header-mail.jpg"><br><br>
				Bonjour '.$prenom.', <br>Votre réponse a bien été prise en compte.<br>
				<br>
				
				
				<strong>Votre choix : </strong>'.$date.'<br>
				
				<ul>
				<li><strong>Nom : </strong> '.$nom.'</li>
				<li><strong>Prénom : </strong> '.$prenom.'</li>
				<li><strong>Site : </strong> '.$site.'</li>
				<li><strong>Entité : </strong> '.$entite.'</li>
				<li><strong>Fonction : </strong> '.$fonction.'</li>
				<li><strong>E-mail : </strong> '.$email.'</li>
				<li><strong>Téléphone : </strong> '.$telephone.'</li>
				</ul>
				
				<strong>Je serai accompagné de : </strong><br>
				
				<ul>
				<li><strong>Nom : </strong> '.$nomacc.'</li>
				<li><strong>Prénom : </strong> '.$prenomacc.'</li>
				<li><strong>E-mail : </strong> '.$emailacc.'</li>
				</ul>
				
				<strong>Je suis amené(e) à organiser des événements : </strong>'.$organisation.'<br><br>
				
				Pour toute information contacter : Catherine Prieur au 01 85 74 00 77 ou c.prieur@arep.co.com<br><br>';
					
				}
				
			

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
