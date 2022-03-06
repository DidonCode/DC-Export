<?php
	session_start();

	if(!isset($_SESSION['id'])){
		session_destroy();
	}

	require('../php/bddConnect.php');

	if(isset($_GET['newsEmail'])){
		$email = $_GET['newsEmail'];

		if(!empty($email)){
			$requete = $PDO->prepare("INSERT INTO newsletter (id, email) VALUES ('0', '$email'
		)");
			$requete->execute();
			header('Location: index.php');
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo $webName; ?></title>

		<link rel="shortcut icon" href="../ressource/images/logo.icon">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/template.css">
		<link rel="stylesheet" type="text/css" href="../css/decoration.css">
		<link rel="stylesheet" type="text/css" href="../css/form.css">
		<link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">
	</head>

	<body>
		<header style="height: 5%">
			<div class="header_top" id="header_top" style="z-index: 6;">
				<div class="wrap">

					<span style="font-size:50px; cursor:pointer; color: white; float: left; width: 10%; margin-left: -80px; margin-top: 8px;" id="btnOpen" onclick="openNav()">&#9776;</span>

					<div class="logo">
						<a href="index.php">
							<img src="../ressource/images/logo.png" width="220" height="50" style="margin-top: 10px;">
						</a>
					</div>

					<br><br>

					<div id="menu" style="margin-top: -20px;">
						<li class="button">
							<button onclick="JavaScript:smoothScroll(1500, 'Accueil')">Accueil</button>
						</li>

						<li class="button">
							<button onclick="JavaScript:smoothScroll(1500, 'Offres')">Offres</button>
						</li>

						<li class="button">
							<button onclick="JavaScript:smoothScroll(1500, 'Contacte')">Contacte</button>
						</li>

						<?php
							if(isset($_SESSION['id'])){
								echo'<li class="button">',
										'<a href="account/panel-client.php" style="text-decoration: none;"><button>Compte</button></a>',
									'</li>',

									'<li class="login">',
										'<a href="../php/accountDestroy.php" style="text-decoration: none;"><button>Déconnexion</button></a>',
									'</li>';
							}else{
								echo'<li class="button">',
										'<a href="account/signin.php" style="text-decoration: none;"><button>Se connecter</button></a>',
									'</li>',

									'<li class="login">',
										'<a href="account/signup.php" style="text-decoration: none;"><button>S\'inscrire</button></a>',
									'</li>';
							}
						?>
					</div>
				</div>
			</div>
		</header>

		<div style="padding-top: 100px; padding-bottom: 100px;"></div>

		<table align="center">
			<tr>
				<td>
					<img src="../ressource/images/presentation.png">
				</td>

				<td style="max-width: 450px; color: white;padding-left: 100px;">
					<h1 style="font-size: 2.8em;"><?php echo $webName; ?></h1>
					<h2>Nous sommes prêts à fournir une gamme complète de services, de la conception et à l'installation, ce qui nous aide à offrir le meilleur rapport qualité-prix à nos clients.</h2>
				</td>
			</tr>
		</table>

		<br><br>

		<div class="Decoup"></div>

		<section class="arg1" id="Accueil">

			<br><br>

			<table align="center">
				<tr>
					<td style="max-width: 600px; padding-right: 100px;">
						<h1 style="font-size: 2.8em; color: black;">Nos fiertés.</h1>
						<h2>Nous sommes fiers de dire que nous avons déjà gagné une communauté fidèle. Nous aimons notre communauté et sommes enthousiasmés par le fait que nous avons établi une très forte présence dans le développement et que nous sommes devenus une destination préférée pour nos clients</h2>
					</td>

					<td>
						<img src="../ressource/images/presentation2.png">
					</td>
				</tr>
			</table>

			<br><br>

		</section>

		<section class="arg2" id="Offres">
			
			<br>

			<table align="center" class="Service-icon" style="text-overflow: ellipsis;">
				<tr>
					<td>
						<div class="icon">
							<i class="fas fa-pencil-ruler"></i>
							<h2>Conception</h2>
						</div>
						<br>
						<h3>Création de la conception du service demandée</h3>
					</td>

					<td>
						<div class="icon">
							<i class="fas fa-globe-europe"></i>
							<h2>Site Web</h2>
						</div>
						<br>
						<h3>Création de sites avec multilangage Php, Html, Css, Js</h3>
					</td>

					<td>
						<div class="icon">
							<i class="fas fa-chart-line"></i>
							<h2>Optimisation</h2>
						</div>
						<br>
						<h3>Analyse et réglage du code pour une meilleure obtimisation possible</h3>
					</td>
				</tr>

				<tr>
					<td>
						<div class="icon">
							<i class="fas fa-comments"></i>
							<h2>Support</h2>
						</div>
						<br>
						<h3>Support personalisé et disponible 7j/7 et 24h/24</h3>
					</td>

					<td>
						<div class="icon">
							<i class="fas fa-shield-alt"></i>
							<h2>Sécurité</h2>
						</div>
						<br>
						<h3>Code sécurisé aucune fuite et sans virus</h3>
					</td>

					<td>
						<div class="icon">
							<i class="fas fa-server"></i>
							<h2>Dépannage</h2>
						</div>
						<br>
						<h3>Technitien disponible 7j/7 et 24h/24 pour effectuer des réparations ou des maintenances</h3>
					</td>
				</tr>
			</table>

		</section>

		<footer id="Contacte">

			<br><br>

			<div align="center">
				<table class="Contacte">
					<tr align="center">
						<td style="padding-right: 80px;">
							<h2 style="color: white;">Réseaux</h2>
						</td>

						<td>
							<h2 style="color: white;">Notre news letter</h2>
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

						<td>
							<form method="GET">
								<input type="email" name="newsEmail" placeholder="Votre addresse mail" class="Formu" style="width: 250px;">
							</form>
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

		<script src="../js/smoothScroll.js"></script>
		<script src="../js/navBar.js"></script>

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
			<button onclick="JavaScript:smoothScroll(1500, 'Accueil'); closeNav()"><a>Accueil</a></button>
			<br>
			<button onclick="JavaScript:smoothScroll(1500, 'Offres'); closeNav()"><a>Offres</a></button>
			<br>
			<button onclick="JavaScript:smoothScroll(1500, 'Contacte'); closeNav()"><a>Contacte</a></button>
		</div>
	</body>
</html>

<script>
	var navbar = document.getElementById("header_top");

	var sticky = navbar.offsetTop;
	window.onscroll = function(){
		if(window.pageYOffset >= sticky){
			navbar.classList.add("sticky");
		}else{
			navbar.classList.remove("sticky");
		}
	}
</script>