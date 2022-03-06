<div id="overlay" class="overlay">
	<div id="popup" class="popup">
		<a onclick="JavaScript:closePopup()" style="float: right; font-size: 2.2em; cursor: pointer;">&times;</a>
		<br>
		<h2 id="header">
			<!-- <i class="fas fa-check" style="color: green;"></i> -->
		</h2>
		<h4 id="text" style="color: green;"></h4>
	</div>
</div>

<script src="../../js/popup.js"></script>

<?php
	echo '<script src="../../js/popup.js">openPopup("Validé", "Votre compte a bien été crée, un mail de verification vous a été envoiée");</script>';

	session_start();

	if(!isset($_SESSION['id'])){
		session_destroy();
	}

	require('../../php/bddConnect.php');
	require('../../php/mail.php');

	if(isset($_GET['send'])){
		$name = $_GET['name'];
		$first_name = $_GET['first_name'];
		$pseudo = $_GET['pseudo'];
		$city = $_GET['city'];
		$region = $_GET['region'];
		$address = $_GET['address'];
		$email = $_GET['email'];
		$password = $_GET['password'];

		$date = date(j/m/Y);

		if(!empty($name) AND !empty($first_name) AND !empty($pseudo) AND !empty($city) AND !empty($region) AND !empty($address) AND !empty($email) AND !empty($password)){
			$requestP = $PDO->prepare("SELECT * FROM account WHERE pseudo='$pseudo'");
			$requestE = $PDO->prepare("SELECT * FROM account WHERE email='$email'");

			$requestP->execute();
			$requestE->execute();

			$pseudoN = $requestP->rowCount();
			$emailN = $requestE->rowCount();

			if($pseudoN == 0){
				if($emailN == 0){
					$request = $PDO->prepare("INSERT INTO account (id, name, firstname, pseudo, city, region, address, email, password, created_date, grade, pp, validate) VALUES ('0', '$name', '$first_name', '$pseudo', '$city', '$region', '$address', '$email', '$password', '$date', 'user', '', '')");
					$request->execute();

					SendVerifMail($email);

					echo '<script src="../../js/popup.js">openPopup("Validé", "Votre compte a bien été crée, un mail de verification vous a été envoiée");</script>';
				}else{
					header('Location: signup.php?error=Cette adresse mail est déjà utilisée');
				}
			}else{
				header('Location: signup.php?error=Ce pseudo est déjà utilisé');
			}
		}else{
			header('Location: signup.php?error=Tous les champs ne sont pas complétés');
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $webName; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../../css/fontawesome/css/all.css">
		<link rel="shortcut icon" href="../../ressource/images/logo.icon">
		<link rel="stylesheet" type="text/css" href="../../css/template.css">
		<link rel="stylesheet" type="text/css" href="../../css/decoration.css">
		<link rel="stylesheet" type="text/css" href="../../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
		<link rel="stylesheet" type="text/css" href="../../css/popup.css">
	</head>

	<body>
		<header style="height: 5%">
			<div class="header_top" id="header_top" style="z-index: 6;">
				<div class="wrap">

					<span style="font-size:50px; cursor:pointer; color: white; float: left; width: 10%; margin-left: -80px; margin-top: 8px;" id="btnOpen" onclick="openNav()">&#9776;</span>

					<div class="logo">
						<a href="../index.php">
							<img src="../../ressource/images/logo.png" width="220" height="50" style="margin-top: 10px;">
						</a>
					</div>

					<br><br>

					<div id="menu" style="margin-top: -20px;">
						<li class="button">
							<button onclick="location.href='../index.php'">Accueil</button>
						</li>

						<?php
							if(isset($_SESSION['id'])){
								echo'<li class="button">',
										'<a href="panel-client.php" style="text-decoration: none;"><button>Compte</button></a>',
									'</li>',

									'<li class="login">',
										'<a href="../../php/accountDestroy.php" style="text-decoration: none;"><button>Déconnexion</button></a>',
									'</li>';
							}else{
								echo'<li class="button">',
										'<a href="signin.php" style="text-decoration: none;"><button>Se connecter</button></a>',
									'</li>',

									'<li class="login">',
										'<a href="signup.php" style="text-decoration: none;"><button>S\'inscrire</button></a>',
									'</li>';
							}
						?>
					</div>
				</div>
			</div>
		</header>

		<section>
			<br><br><br><br><br><br><br><br>

			<h1 align="center" style="color: white;">Formulaire d'insciption</h1>

			<hr style="width: 10%;">

			<br><br>

			<form action="" method="GET" style="text-align: center;">
				<input type="text" name="name" placeholder="Nom" class="Formu">
				<input type="text" name="first_name" placeholder="Prenom" class="Formu">

				<br><br>

				<input type="text" name="pseudo" placeholder="Pseudo" class="Formu" style="width: 645px;">

				<br><br><br><br>

				<input type="text" name="city" placeholder="Ville" class="Formu">
				<input type="text" name="region" placeholder="Region" class="Formu">

				<br><br>

				<input type="text" name="address" placeholder="Adresse Postale" class="Formu" style="width: 645px;">

				<br><br><br><br>

				<input type="email" name="email" placeholder="Adresse Mail" class="Formu" style="width: 645px;">

				<br><br>

				<input type="password" name="password" placeholder="Mot De Passe" class="Formu" style="width: 645px;">

				<br><br>

				<div align="center" style="color: white;">
					<label>Si vous êtes déjà inscrit vous pouvez vous connecter <a href="signin.php" style="text-decoration: none; color: #7accc8;">ici</a></label>
					<br><br>
					<label style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></label>
				</div>

				<br><br>

				<input type="submit" name="send" value="S'inscrire" id="FormuBtn">

				<br><br><br>

				<hr style="width: 40%;">

			</form>
		</section>

		<footer id="Contacte">

			<br><br>

			<div align="center">
				<table class="Contacte">
					<tr align="center">
						<td style="padding-right: 80px;">
							<h2 style="color: white;">Réseaux</h2>
						</td>

						<td style="padding-left: 80px;">
							<h2 style="color: white;">Coordonnées</h2>
						</td>
					</tr> 

					<tr align="center">
						<td style="padding-right: 80px;">
							<a href="<?php echo $reseaux1; ?>" target="_blank">
								<i class="fab fa-paypal" id="Reseaux"></i>
							</a>

							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							<a href="<?php echo $reseaux2; ?>" target="_blank">
								<i class="fab fa-twitter" id="Reseaux"></i>
							</a>

							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							<a href="<?php echo $reseaux3; ?>" target="_blank">
								<i class="fab fa-discord" id="Reseaux"></i>
							</a>
						</td>

						<td style="padding-left: 80px;">
							<h4 style="color: white">support@dc-developpement.fr</h4>
							<h4 style="color: white">dc-developpement.france@gmail.fr</h4>
						</td>
					</tr>
				</table>
			</div>
		</footer>

		<script src="../../js/navBar.js"></script>

		<div id="list" class="menu-list" style="z-index: 7;">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

			<br>

			<?php
				if(isset($_SESSION['id'])){
					echo '<a href="../php/accountDestroy.php">',
							'<button style="background: #1dbf73; color:white; padding: 15px; font-size: 15px; border-radius: 4%; border: none;">Déconnexion</button>',
						 '</a>',

						 '<br>',

						 '<button><a href="account/panel-client.php">Compte</a></button>';
				}else{
					echo '<a href="account/signup.php">',
							'<button style="background: #1dbf73; color:white; padding: 15px; font-size: 15px; border-radius: 4%; border: none;">S\'inscrire sur <?php echo $webName; ?></button>',
						 '</a>',

						 '<br>',

						 '<button><a href="account/signin.php">Se connecter</a></button>';
				}
			?>

			<br>
			<button><a href="../index.php">Accueil</a></button>
		</div>
	</body>
</html>