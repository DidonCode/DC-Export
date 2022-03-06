<?php
	session_start();

/*	if(!isset($_SESSION['id'])){
		session_destroy();
	}
*/
	require('../../php/bddConnect.php');

	if(isset($_GET['send'])){
		$address_pseudo = $_GET['address_pseudo'];
		$password = $_GET['password'];

		if(!empty($address_pseudo) AND !empty($password)){
			if(strpos($address_pseudo, "@")){
				$request = $PDO->prepare("SELECT * FROM account WHERE email='$address_pseudo' AND password='$password'");
			}else{
				$request = $PDO->prepare("SELECT * FROM account WHERE pseudo='$address_pseudo' AND password='$password'");		
			}

			$request->execute();
			$accountN = $request->rowCount();

			if($accountN == 1){
				$accountD = $request->fetch();

				if($accountD['validate'] == 'done'){

					$_SESSION['id'] = $accountD['id'];
					$_SESSION['name'] = $accountD['name'];
					$_SESSION['firstname'] = $accountD['firstname'];
					$_SESSION['pseudo'] = $accountD['pseudo'];
					$_SESSION['city'] = $accountD['city'];
					$_SESSION['region'] = $accountD['region'];
					$_SESSION['address'] = $accountD['address'];
					$_SESSION['email'] = $accountD['email'];
					$_SESSION['grade'] = $accountD['grade'];
					$_SESSION['pp'] = $accountD['pp'];

					header('Location: panel-client.php?dashboard=dashboard');
				}else{
					header('Location: signin.php?error=Vous n\'avez pas confirmer vote adresse mail');
				}
			}else{
				header('Location: signin.php?error=Mauvais identifiant ou mot de passe');
			}
		}else{
			header('Location: signin.php?error=Tous les champs ne sont pas remplis');
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

			<h1 align="center" style="color:white;">Connexion</h1>

			<hr style="width: 10%;">

			<br><br>

			<form action="" method="GET" style="text-align: center;">

				<input type="text" name="address_pseudo" placeholder="Adresse Mail ou Pseudo" class="Formu" style="width: 500px;">

				<br><br>

				<input type="password" name="password" placeholder="Mot De Passe" class="Formu" style="width: 500px;">

				<br><br>

				<div align="center" style="color: white;">
					<label>Si vous êtes pas déjà inscrit vous pouvez vous inscrire <a href="signup.php" style="text-decoration: none; color: #7accc8;;">ici</a></label>
					<br><br>
					<label><a href="" style="text-decoration: none; color: darkred;">Mot de passe oublié</a></label>
					<br>
					<label style="color: red;"><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></label>
				</div>

				<br><br>

				<input type="submit" name="send" value="S'identifier" id="FormuBtn">

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

			<br><br>

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