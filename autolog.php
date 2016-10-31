<?php
	session_start();
	define('USER', 'arep_CATB');
	define('HOST', '142.4.214.101');
	define('PASSWORD', 'arep-sa');
	define('DATABASE', 'PWC_INSCRIPTION');

	$bdd = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);	
	$sql = 'SELECT id FROM INSCRIPTIONS WHERE email = "'.$_GET['email'].'" && password = "'.$_GET['password'].'"';
	$check = $bdd->query($sql);
	$result = $check->fetch();
	
	if($result[0] != '') {
		$_SESSION['id'] = $result[0];
		header('Location: inscription.php');
	}else{
		header('Location: index.php');
	}
?>