<!-- TEST CHANGE GIT -->
<?php
	require 'security.php';
	require 'get-info.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Rencontres PwC-AREP</title>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<style> 
	.show {
		display: block;
	}

	.show2 {
		display: none;
	}

	.participation-no {
		display: none;
	}
</style>
</head>	

<?php
	ini_set('display_errors','on');
	error_reporting(E_ALL);
	$attente = 0;
	$bdd = new PDO('mysql:host=142.4.214.101;dbname=PWC_INSCRIPTION', 'arep_CATB', 'arep-sa');
	$request = "SELECT * FROM PLACES";
	$exec = $bdd->query($request);
	$places = $exec->fetch();
?>



<body>
<div id="global">
	<div id="header">
		<img src="img/header.jpg">
	</div>
	<div id="content">
		<?php	
			$checkForm = $result['checkform'];
			$inscriptionOff = 0;
			if($inscriptionOff == 1) {
				echo '<p id="msg-div"><span id="msg" class="warning"><i></i> <span>Les inscriptions sont actuellement fermées</span>.</span></p>';
			}else{
			if($checkForm == 0) {
		?>
		<form id="form">

			<p style="display:none;">Je souhaite participer à une des rencontres<br><br>
				<span class="zone">
					<label>
						<input type="radio" name="participation" value="oui" input-type="radio" checked>
						Oui
					</label>
					<label>
						<input type="radio" name="participation" value="non" input-type="radio">
						Non
					</label>
				</span>
			</p>	

			<span class="show"> 

			<p>
				<span class="zone">
					<span style="color:#ea8c12">Rendez-vous à l'hôtel Mövenpick - 58 Boulevard Victor Hugo, 92200 Neuilly-sur-Seine</span><br><br>
					<label <?php if(($places['DATE1'] == 0)) {echo 'class="color9"';} ?>><input type="radio" name="date" value="date1" input-type="radio2" class="inputcontact" <?php if(($places['DATE1'] == 0)) {echo 'disabled';} ?>> <span style="margin-right:2px;">Lundi 7 novembre 2016 -</span> <span style="color:#e74f01; font-size: 10pt;">Rencontre & Afterwork de 17h30 à 19h00 <?php if(($places['DATE1'] > 0)) {}else{echo '(session complète)';} ?></span></label>

					<?php echo $places['DATE1']; if($places['DATE1'] == 0) { ?>
					<label style="margin-bottom:6px;"><input type="radio" name="date" value="date3" input-type="radio2" class="inputcontact"> Je m'inscris sur la liste d’attente en cas de désistement <span style="font-size: 10pt;">(lundi 7 novembre 2016)</span></label>
					<?php } ?>

					<label <?php if(($places['DATE2'] == 0)) {echo 'class="color9"';} ?>><input type="radio" name="date" value="date2" input-type="radio2" class="inputcontact" <?php if(($places['DATE2'] == 0)) {echo 'disabled';} ?>> <span>Mardi 8 novembre 2016 -</span> <span style="color:#e74f01; font-size: 10pt;">Rencontre & Cocktail déjeunâtoire de 12h00 à 13h30 <?php if(($places['DATE2'] > 0)) {}else{echo '(session complète)';} ?></span></label>

					<?php if($places['DATE2'] == 0) { ?>
					<label><input type="radio" name="date" value="date4" input-type="radio2" class="inputcontact"> Je m'inscris sur la liste d’attente en cas de désistement <span style="font-size: 10pt;">(mardi 8 novembre 2016)</span></label>
					<?php } ?>

					<label><input type="radio" name="date" value="date5" input-type="radio2" class="inputcontact"> Je ne pourrai pas être disponible et souhaite être recontacté(e)</label>

					<input type="radio" name="date" value="date6" input-type="radio2" style="display:none;"> 
				</span>	
			</p>	
			
			<p class="showcontact">
				<span class="zone">
					<label><input type="radio" name="represente" value="Je participerai" input-type="radio9" checked> Je participerai</label>
					<label><input type="radio" name="represente" value="Je ne pourrai me rendre disponible et serai représentée" input-type="radio9" id="tierce"> Je ne pourrai pas me rendre disponible et serai représenté(e) par</label>
				</span>	
			</p>
			<p>Nom<br><input type="text" name="nom" input-type="empty" title="nom" class="reset-tierce" value="<?php echo $result['nom']; ?>"></p>
			<p>Prénom<br><input type="text" name="prenom" input-type="empty" title="prenom" class="reset-tierce" value="<?php echo $result['prenom']; ?>"></p>
			<p>Site PwC (Paris, Bordeaux, Lille...)<br><input type="text" name="site" input-type="empty" title="site" class="reset-tierce" value="<?php echo $result['site']; ?>"></p>
			<p>Entité (IFS, Audit, Consulting...)<br><input type="text" name="entite" input-type="empty" title="entité"></p>
			<p>Fonction<br><input type="text" name="fonction" input-type="empty" title="fonction" class="reset-tierce" value="<?php echo $result['fonction']; ?>"></p>
			<p>E-mail<br><input type="text" name="email" input-type="email" class="reset-tierce" value="<?php echo $result['email']; ?>"></p>
			<p>Téléphone<br><input type="text" name="telephone" input-type="empty" title="téléphone"></p>
			
			<p class="showacc">Je serai accompagné(e) de<br>
          		<span class="zone">
          			<label>Nom<br><input type="text" name="nomacc" class="reset-acc" style="margin-top:5px;"></label>
					<label style="margin-top:10px;">Prénom<br><input type="text" name="prenomacc" class="reset-acc" style="margin-top:5px;"></label>
					<label style="margin-top:10px;">E-mail<br><input type="text" name="emailacc" class="reset-acc" style="margin-top:5px;"></label>
          		</span>
          	</p>
			

			<p>Je suis amené(e) à organiser des événements<br>
				<span class="zone">
					<label>
						<input type="radio" name="organisation" value="oui" input-type="radio3">
						Oui
					</label>
					<label>
						<input type="radio" name="organisation" value="non" input-type="radio3">
						Non
					</label>
				</span>
			</p>
 
			</span>
			<span class="show2">	
          	
          	<p>J'organise des <br>
          		<span class="zone">
          			<label><input type="checkbox" name="type-event[]" value="Conventions"> Conventions</label> <br>
          			<label><input type="checkbox" name="type-event[]" value="Formations"> Formations</label> <br>
          			<label><input type="checkbox" name="type-event[]" value="Réunions"> Réunions</label> <br>
          			<label><input type="checkbox" name="type-event[]" value="Séminaires"> Séminaires</label> <br>
          			<label><input type="checkbox" name="type-event[]" value="Soirées"> Soirées</label> <br>
          			<label><input type="checkbox" name="type-event[]" value="Staff days"> Staff days</label> <br><br>

          			<label style="margin-top:10px;">Si autre, préciser<br><input type="text" name="autre" style="margin-top:5px;"></label>
          		</span>
          	</p>	
			
            <p>Nombre d'événements organisés par an<br><input type="text" name="nb-event" title="nombre d'évenement"></p>

            <p>Effectif moyen par événement<br><input type="text" name="effectif" title="Effectif moyen"></p>

            <p>Périodes de vos événements<br>
            	<span class="zone">
          			<label><input type="checkbox" name="periode[]" value="janvier"> janvier</label> <br>
          			<label><input type="checkbox" name="periode[]" value="février"> février</label> <br>
          			<label><input type="checkbox" name="periode[]" value="mars"> mars</label> <br>
          			<label><input type="checkbox" name="periode[]" value="avril"> avril</label> <br>
          			<label><input type="checkbox" name="periode[]" value="mai"> mai</label> <br>
          			<label><input type="checkbox" name="periode[]" value="juin"> juin</label> <br> 
          			<label><input type="checkbox" name="periode[]" value="juillet"> juillet</label> <br>
          			<label><input type="checkbox" name="periode[]" value="août"> août</label> <br>
          			<label><input type="checkbox" name="periode[]" value="septembre"> septembre</label> <br>
          			<label><input type="checkbox" name="periode[]" value="octobre"> octobre</label><br>
          			<label><input type="checkbox" name="periode[]" value="novembre"> novembre</label><br>
          			<label><input type="checkbox" name="periode[]" value="décembre"> décembre</label><br>
          		</span>	
            </p>
            
          	</span>

          	<span class="participation-no">
          		<p>Je ne souhaite pas participer parce que<br><br>
					<span class="zone">
						<label>
							<input type="radio" name="raison" value="Pas disponible">
							Je ne suis pas disponible
						</label>
						<label>
							<input type="radio" name="raison" value="Pas amené à organiser des événements">
							Je ne suis pas amené à organiser des événements.
						</label>
					</span>
				</p>		
          	</span>

			<p id="msg-div" style="display:none;"><span id="msg" class="warning"><i></i> <span>Attention, une erreur est survenue</span>.</span></p>
			<p id="btn"><input type="submit" value="Valider"></p>
		</form>
		<?php
			}else{
		?>
		<p id="msg-div"><span id="msg" class="success"><i></i> <span>Vous avez déjà rempli le formulaire</span>.</span></p>		
		<?php
			}
			}
		?>	
		
		<p>Pour toute information contacter :<br>Catherine Prieur au 01 85 74 00 77 ou c.prieur@arep.co.com
		<br><br></p>
		
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/formulaire.js"></script>
</body>
</html> 