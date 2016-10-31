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
</head>

<body>
<div id="global">
	<div id="header">
		<img src="img/header.jpg">
	</div>
	<div id="content">
		<form id="form">
			<p><input type="text" name="email" placeholder="E-mail" input-type="empty" title="e-mail"></p>
			<p><input type="password" name="password" placeholder="Mot de passe" input-type="empty" title="mot de passe"></p>
			<input type="hidden" name="login" value="ok">
			<p id="msg-div" style="display:none;"><span id="msg" class="warning"><i></i> <span>Attention, une erreur est survenue</span>.</span></p>
			<p id="btn"><input type="submit" value="Connexion"></p>
		</form>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="js/formulaire.js"></script>
</body>
</html>