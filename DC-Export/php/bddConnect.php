<?php
	$PDO = null;

	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'dc-export';

	try{
		$PDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "Erreur : " . $e->getMessage();
	}

	$request = $PDO->prepare("SELECT * FROM website");
	$request->execute();

	$resultD = $request->fetchAll();

	$webName = $resultD[0][0];
	$reseaux1 = $resultD[0][1];
	$reseaux2 = $resultD[0][2];
	$reseaux3 = $resultD[0][3];

	return $webName;
	return $reseaux1;
	return $reseaux2;
	return $reseaux3;
?>