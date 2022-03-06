<?php
	session_start();

	if(!isset($_SESSION['id'])){
		header('Location: ../../php/accountDestroy.php');
	}

	require('../../php/bddConnect.php');

	$vide = "'";

	$request = $PDO->prepare("SELECT * FROM command WHERE pseudo=?");
	$request->execute(array($_SESSION['pseudo']));

	$orderD = $request->fetchAll();
	$orderN = $request->rowCount();

	if(isset($_GET['order'])){
		$orderMin = 10;
		$orderMax = 20;
	}elseif(isset($_GET['dashboard'])){
		$orderMin = 5;
		$orderMax = 10;
	}else{
		$orderMin = 0;
		$orderMax = 0;
	}

	$request = $PDO->prepare("SELECT * FROM message WHERE recever=? AND view='no'");
	$request->execute(array($_SESSION['pseudo']));

	$messageD = $request->fetchAll();
	$messageN = $request->rowCount();

	$request = $PDO->prepare("SELECT * FROM command WHERE pseudo=? AND dllink IS NOT NULL");
	$request->execute(array($_SESSION['pseudo']));

	$archiveD = $request->fetchAll();
	$archiveN = $request->rowCount();

	if(isset($_GET['archiver'])){
		$archiveMin = 10;
		$archiveMax = 20;
	}elseif(isset($_GET['dashboard'])){
		$archiveMin = 5;
		$archiveMax = 10;
	}else{
		$archiveMin = 0;
		$archiveMax = 0;
	}

/*	for ($i=0; $i < 1; $i++) { 
		$requestt = $PDO->prepare("INSERT INTO command (id, pseudo, type, description, price, promo, startdate, enddate, state, dllink) VALUES ('0', 'Didon Code', 'Script', 'test', '5', ' ', '05/12/2025', '05/12/2025', '0', 'NULL')");
		$requestt->execute();
	}*/

/*	for ($i=0; $i < 10; $i++) { 
		$requestt =$PDO->prepare("UPDATE command SET dllink = '$i' WHERE id = ?");
		$requestt->execute(array($i));
	}*/
?>

<!DOCTYPE html>
<html style="height: 100%; width: 100%;">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $webName; ?></title>

		<link rel="stylesheet" type="text/css" href="../../css/fontawesome/css/all.css">
		<link rel="shortcut icon" href="../../ressource/images/logo.icon">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../../css/form.css">
	</head>

	<body style="background-color: #e5e5e5; height: 100%; width: 100%;" id="body">
		<div style="position: absolute; top: 0; left: 0; width: 250px; height: 100%; background-color: #13273e; z-index: 5;" id="nav">
			<div style="padding: 25px; padding-left: 40px; clear: both;">
				<a href="../../index.php"><img src="../../ressource/images/logo.png" width="180" height="45"></a>
				<br><br><br><br>
				<a onclick="window.location.href='panel-client.php?dashboard=dashboard'"><i class="fas fa-bars"></i>&nbsp;&nbsp; Dashboard</a>
				<br>
				<a onclick="window.location.href='panel-client.php?profil=profil'"><i class="fas fa-user"></i>&nbsp;&nbsp; Profil</a>
				<br>
<!-- 				<a href=""><i class="fas fa-file-alt"></i>&nbsp;&nbsp; Bill</a>
				<br> -->
				<a onclick="window.location.href='panel-client.php?order=order'"><i class="fas fa-clipboard"></i>&nbsp;&nbsp; Order</a>
				<br>
				<a onclick="window.location.href='panel-client.php?archiver=archiver'"><i class="fas fa-archive"></i>&nbsp;&nbsp; Archiver</a>
				<br>
				<a onclick="window.location.href='panel-client.php?support=support'"><i class="fas fa-question-circle"></i>&nbsp;&nbsp; Support</a>
			</div>
		</div>

		<div style="position: absolute; top: 0; width: 100%; height: 80px; background-color: white; z-index: -1;" id="header">
			<div style="padding-left: 260px; float: left;">
				<h2 style="font-size: 30px; padding-top: 10px;">Dashboard</h2>
			</div>

			<div style="float: right;">
				<span style="display: inline-flex; padding-right: 30px;">
					<img src="../../ressource/cloud/pp/<?php echo $_SESSION['pp']; ?>" width="50" height="50" style="border-radius: 50%; margin-top: 15px;">
					&nbsp;&nbsp;&nbsp;&nbsp;
					<h3 style="margin-top: 30px;"><?php echo $_SESSION['firstname'].' '.$_SESSION['name']; ?></h3>
				</span>
			</div>
		</div>

		<div style="position: absolute; margin-top: 80px; margin-left: 250px; padding: 10px;">
			<div class="panel panel-default" id="order">
				<div class="panel-heading">Your Orders: <?php echo $orderN; if($orderN >= $orderMax){ echo '&nbsp;&nbsp;&nbsp; <a onclick="window.location.href='.$vide.'panel-client.php?order=order'.$vide.'">Tous voirs</a>'; } ?></div>

				<div class="panel-body" style="display: inline-flex;">
					<table style="padding: 5px;">
						<tr>
							<td>#</td>
							<td>Produit</td>
							<td>Description</td>
							<td>Price</td>
							<td>State</td>
							<td>Start Date</td>
							<td>End Date</td>
						</tr>

						<?php	

							for ($i=0; $i < $orderN; $i++) {
								if($i >= $orderMin){
									break;
								}

								$n = $i + 1;

								echo '<tr>';
								echo '<td>'.$n.'</td>';
								echo '<td>'.$orderD[$i][2].'</td>';
								echo '<td>'.$orderD[$i][3].'</td>';
								echo '<td>'.$orderD[$i][4].'</td>';

								if($orderD[$i][8] == 0){
									echo '<td><i class="fas fa-circle" style="color: red;"></i>&nbsp 1er Payment</td>';
								}elseif($orderD[$i][8] == 1){
									echo '<td><i class="fas fa-circle" style="color: orange;"></i>&nbsp Fabrication</td>';
								}elseif($orderD[$i][8] == 2){
									echo '<td><i class="fas fa-circle" style="color: orange;"></i>&nbsp 2ème Payment</td>';
								}elseif($orderD[$i][8] == 3){
									echo '<td><a href="dashboard-archive.php"><i class="fas fa-circle" style="color: green;"></i>&nbsp Livré</a></td>';
								}

								echo '<td>'.$orderD[$i][6].'</td>';
								echo '<td>'.$orderD[$i][7].'</td>';
								echo '</tr>';
							}
						?>
					</table>

					<table style="padding: 5px;">
						<tr>
							<td>#</td>
							<td>Produit</td>
							<td>Description</td>
							<td>Price</td>
							<td>State</td>
							<td>Start Date</td>
							<td>End Date</td>
						</tr>

						<?php
							if($orderN > $orderMin){
								for ($i=$orderMin; $i < $orderN; $i++) {
									if($i >= $orderMax){
										break;
									}

									$n = $i + 1;

									echo '<tr>';
									echo '<td>'.$n.'</td>';
									echo '<td>'.$orderD[$i][2].'</td>';
									echo '<td>'.$orderD[$i][3].'</td>';
									echo '<td>'.$orderD[$i][4].'</td>';

									if($orderD[$i][8] == 0){
										echo '<td><i class="fas fa-circle" style="color: red;"></i>&nbsp 1er Payment</td>';
									}elseif($orderD[$i][8] == 1){
										echo '<td><i class="fas fa-circle" style="color: orange;"></i>&nbsp Fabrication</td>';
									}elseif($orderD[$i][8] == 2){
										echo '<td><i class="fas fa-circle" style="color: orange;"></i>&nbsp 2ème Payment</td>';
									}elseif($orderD[$i][8] == 3){
										echo '<td><a href="dashboard-archive.php"><i class="fas fa-circle" style="color: green;"></i>&nbsp Livré</a></td>';
									}

									echo '<td>'.$orderD[$i][6].'</td>';
									echo '<td>'.$orderD[$i][7].'</td>';
									echo '</tr>';
								}
							}
						?>
					</table>
				</div>
			</div>

			<div class="panel panel-default" id="support">
				<div class="panel-heading">Your Messages: <?php echo $messageN; ?> unread</div>

				<div class="panel-body">
					<?php 
						for ($i=0; $i < $messageN; $i++) {
							if(strlen($messageD[$i][3]) > 50) {
								$rest = substr($messageD[$i][3], 0, 50);
							}else{
								$rest = $messageD[$i][3];
							}

							echo '<p>'.$messageD[$i][1].': '.$rest.'... &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; on: '.$messageD[$i][4].'</p>';
						}
					?>
				</div>
			</div>

			<div class="panel panel-default" id="archiver">
				<div class="panel-heading">Your Archivers: <?php echo $archiveN; if($archiveN >= $archiveMax){ echo '&nbsp;&nbsp;&nbsp; <a onclick="window.location.href='.$vide.'panel-client.php?archiver=archiver'.$vide.'">Tous voirs</a>'; } ?></div>

				<div class="panel-body" style="display: inline-flex;">
					<table>
						<?php
							for($i=0; $i < $archiveMin; $i++) { 
								if($i >= $archiveMin){
									break;
								}

								echo '<tr>';
								echo '<td>'.$archiveD[$i][9].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a><i class="fas fa-download" style="color: black"></i></a></td>';
								echo '</tr>';
							}
						?>
					</table>

					<table>
						<?php
							if($archiveN > $archiveMin){
								for($i=$archiveMin; $i < $archiveN; $i++) { 
									if($i >= $archiveMax){
										break;
									}

									echo '<tr>';
									echo '<td>'.$archiveD[$i][9].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a><i class="fas fa-download" style="color: black"></i></a></td>';
									echo '</tr>';
								}
							}
						?>
					</table>
				</div>
			</div>

<!-- 			<div class="panel panel-default" style="border-radius: 10%;">
				<div class="panel-heading">Your Bill</div>

				<div class="panel-body">
					<h1></h1>
				</div>
			</div> -->

			<div class="panel panel-default" id="profil">
				<div class="panel-heading">Your profils</div>

				<div class="panel-body">
					<h1>PPPP</h1>
				</div>
			</div>
		</div>
	</body>
</html>

<script>
	var body = document.getElementById("body");
	var header = document.getElementById("header");
	var nav = document.getElementById("nav");

	function resize() {
		console.log(body.offsetHeight);
		header.style.width = body.offsetWidth + "px";
		nav.style.height = body.offsetHeight * 1.5 + "px";
	}

	window.onresize = function() {
		resize();
	}

	resize();
</script>

<script>
	function remove(element){
		for (var i = 0; i < element.length; i++) {
			var elementI = document.getElementById(element[i]);
			var elementH = document.getElementById(element[i]).offsetHeight * 1.28;
			elementI.style.visibility = 'hidden';
			elementI.style.marginTop = '-' + elementH + 'px';
		}
		
	}

	function add(element){
		for (var i = 0; i < element.length; i++) {
			var elementI = document.getElementById(element[i]);
			elementI.style.visibility = 'visible';
			elementI.style.marginTop = '0px';
		}
		
	}

	function dashboard() { add(['order', 'support', 'archiver', 'profil']); }
	function profil() { remove(['order', 'support', 'archiver']); add(['profil']); }
	function order() { remove(['support', 'archiver', 'profil']); add(['order']); }
	function archiver() { remove(['order', 'support', 'profil']); add(['archiver']); }
	function support() { remove(['order', 'archiver', 'profil']); add(['support']); }
</script>

<?php
	if(isset($_GET['dashboard'])){
		echo '<script>dashboard();</script>';
	}elseif(isset($_GET['profil'])){
		echo '<script>profil();</script>';
	}elseif(isset($_GET['order'])){
		echo '<script>order();</script>';
	}elseif(isset($_GET['archiver'])){
		echo '<script>archiver();</script>';
	}elseif(isset($_GET['support'])) {
		echo '<script>support();</script>';
	}
?>

<style>
	a{
		text-decoration: none;
		color: #7a80b4;
		font-size: 15px;
		cursor: pointer;
	}

	a i{
		font-size: 20px;
		padding-bottom: 10px;
		padding-top: 10px;
		color: white;
	}

	a:hover{
		color: white;
		text-decoration: none;
	}

	html{
		font: 14px Helvetica,Arial,Book,sans-serif;
	}

	table td{
		padding: 10px;
		border: 0.2px solid #ddd;
		text-align: center;
	}

	table{
		border-collapse: separate;
		text-indent: initial;
    	border-spacing: 2px;
	}
</style>