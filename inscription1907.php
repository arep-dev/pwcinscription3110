<?php
	require 'security.php';
	require 'get-info.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>PwC - Consulting & Strategy End</title>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
</head>

<body>
<?php
	$infos = getAll();
?>	
<div id="global">
	<div id="header">
		<img src="img/logo.gif">
		<div id="menu">
			<a href="inscription.php">
				<div class="menu active">
					Inscription
				</div>
			</a>
			<a href="l-evenement.php">
				<div class="menu">
					L'événement
				</div>
			</a>
		</div>
	</div>
	<div id="content">
		<h1>Inscription "Staff Day Consulting & Strategy"</h1>
		<h2>Le jeudi 15 septembre 2016</h2>
		<?php	
			$checkForm = getCheckForm();
			if($checkForm == 0) {
		?>
		<form id="form">
			<p>Transport<br><br>
				<span class="zone">Nous vous rappelons que vous vous chargez-vous même de votre transport. Notre agence FCM est à votre disposition pour effectuer vos réservations de train ou d'avion, en seconde classe ou en classe économique.</span>
			</p>
			<p>Civilité<br><br>
				<span class="zone">
					<label>
						<input type="radio" name="civilite" value="m" input-type="radio3" <?php if($infos['CIVILITE'] == 'M.'){echo 'checked';} ?> >
						<b>M.</b>
					</label>
					<label>
						<input type="radio" name="civilite" value="mme" input-type="radio3" <?php if($infos['CIVILITE'] == 'Mme'){echo 'checked';} ?> >
						<b>Mme</b>
					</label>
				</span>
			</p>
			<p>Nom<br><br><input type="text" name="nom" input-type="empty" title="nom" value="<?php echo $infos['NOM']; ?>"></p>
			<p>Prénom<br><br><input type="text" name="prenom" input-type="empty" title="prenom" value="<?php echo $infos['PRENOM']; ?>"></p>
			<p>E-mail<br><br><input type="text" name="email" input-type="email" value="<?php echo $infos['EMAIL']; ?>"></p>
			<p>Numéro mobile (fortement recommandé)<br><br><input type="text" name="numero" value="<?php echo $infos['NUMERO']; ?>"></p>
			<p>Grade / Fonction<br><br><input type="text" name="fonction" input-type="empty" title="fonction" value="<?php echo $infos['FONCTION']; ?>"></p>
			<p>BU<br><br><input type="text" name="bu" input-type="empty" title="BU" value="<?php echo $infos['BU']; ?>"></p>
			<p>Serez-vous présent ?<br><br>
				<span class="zone">
					<label>
						<input type="radio" name="participation" value="oui" input-type="radio">
						Je participerai
					</label>
					<label>
						<input type="radio" name="participation" value="non" input-type="radio">
						Je ne participerai pas
					</label>
				</span>
			</p>
			<p>Participation<br><br>
				<span class="zone">
					<label>
						<input type="checkbox" input-type="checkbox" name="participation-team" value="oui">
						Activité
					</label>
					<label>
						<input type="checkbox" input-type="checkbox" name="participation-diner" value="oui">
						Dîner
					</label>
				</span>
			</p>
			<?php
				$province = getProvince();
				if($province == 1) {
			?>
			<p>Hôtel<br>Souhaitez-vous un hébergement pour la nuit du jeudi 15 au vendredi 16 septembre 2016 ?<br><br>
				<span class="zone">
					<label>
						<input type="radio" name="hebergement" value="oui" input-type="radio2">
						Oui
					</label>
					<span id="showme">
						Je souhaite partager ma chambre avec :
						<input type="text" name="acc" title="acc">
					</span>
					<label style="margin-bottom:5px;">
						<input type="radio" name="hebergement" value="non" input-type="radio2">
						Non
					</label>
				A votre arrivée sur le lieu de l'activité, vos bagages seront pris en charge par l'agence Arep-Exigences.<br>
				Nous vous remercions de bien étiquetter vos bagages à votre nom.
				</span>
			</p>
			<?php
				}
			?>
			<p>Commentaires (ex : femme enceinte, allergie, etc.)<br><br><input type="text" name="commentaire"></p>
			<p id="msg-div" style="display:none;"><span id="msg" class="warning"><i></i> <span>Attention, une erreur est survenue</span>.</span></p>
			<p id="btn"><input type="submit" value="Inscription"></p>
			<input type="hidden" name="id" value="<?php echo $_SESSION['id']?>">
		</form>
		<?php
			}else{
		?>
		<p id="msg-div"><span id="msg" class="success"><i></i> <span>Vous avez déjà rempli le formulaire</span>.</span></p>		
		<?php
			}
		?>	
		
		<h3 style="margin-top:15px;">Votre contact Arep-Exigences, en cas de modification</h3>
		<p>Léonard Blanvillain<br>
		Tél. : 01 85 74 00 41<br>
		E-mail : l.blanvillain@arep.co.com
		<br><br></p>
		
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/formulaire.js"></script>
</body>
</html> 