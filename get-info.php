<?php 
	define('USER', 'arep_CATB');
	define('HOST', '142.4.214.101');
	define('PASSWORD', 'arep-sa');
	define('DATABASE', 'PWC_INSCRIPTION');

		$bdd = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);	
		$bdd->exec("SET CHARACTER SET utf8");
		$sql = 'SELECT * FROM INSCRIPTIONS WHERE id = "'.$_SESSION['id'].'"';
		$check = $bdd->query($sql);
		$result = $check->fetch();
		return $result;
?>