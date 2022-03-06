<?php
	
	require('bddConnect.php');

	function SendMail($destinataire, $sujet, $entete, $message){
		mail($destinataire, $sujet, $message, $entete); // Envoi du mai
	}

	function SendMailSupport($receveur, $message){
		mail("support@dc-developpement.fr", "Message support DC-Développement", $message, "Message en provenence de: ".$receveur.""); // Envoi du mai
	}

	function SendVerifMail($destinataire){
		global $PDO;

		$sujet = "Activer votre compte";
		$entete = "From: verif@dc-developpement.fr";
	 
		// Le lien d'activation est composé du login(log) et de la clé(cle)
		$cle = md5(microtime(TRUE)*100000);
		$cle = urlencode($cle);

		$message = 'Bienvenue sur DC-Développement,
		 
		Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
		ou copier/coller dans votre navigateur Internet.
		 
		http://dc-developpement.fr/fr/php/Mail.php?cle='.$cle.'
		 
		 
		---------------
		Ceci est un mail automatique, Merci de ne pas y répondre.';

		$insert = "UPDATE account SET validate = '$cle' WHERE email = '$destinataire'";
		$requser = $PDO->query($insert);

		mail($destinataire, $sujet, $message, $entete); // Envoi du mail
	}

	if(isset($_GET['cle'])){
		$key = $_GET['cle'];

		$requeser = $PDO->prepare("SELECT * FROM account WHERE validate = ?");
		$requeser->execute(array($key));
		$Nuser = $requeser->rowCount();
		$Duser = $requeser->fetch();

		if($Nuser == 1){
			$insert = "UPDATE account SET validate = 'done' WHERE id = ".$Duser['id']."";
			$requser = $PDO->query($insert);

			header("Location: ../fr/account/signin.php");
		}else{
			header("Location: ../fr/index.php");
		}
	}
	
?>