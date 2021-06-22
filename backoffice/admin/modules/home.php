<?php
// inclus le fichier de la page de connection utilisateurs
include 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Project Blog</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<!-- Systeme de session (protection, obligation de ce connecter) -->
<?php
session_start();
if ($_SESSION["autoriser"] != "oui") {
	header("location:login.php");
	exit();
}
if (date("H") < 24) {
	$bienvenue = "Welcome " .
		$_SESSION["prenomNom"] .
		" ";
} else {
			//    si non autoriser,ce message 
			echo '<script>alert("access denied")</script>';
			// redirection, sinon page blanche
			header("location:deconnect.php");
}
?>
<!-- fin Systeme de session (protection = obligation de ce connecter) -->

<!-- Afficher qui est connecter ainsi qu'un message de bienvenue et le lien pour ce déconnecter -->

<body onLoad="document.fo.login.focus()">
	<h2><?php echo $bienvenue ?></h2>
	<!-- redirection vers la page principâl lors de la deconnection -->
	[ <a href="deconnect.php">deconnexion</a> ]
</body>

</html>
<!-- logo -->
<div class="logo">
	<a href="../../../index.php"> <img src="../img/afsflogo.png" class="afsflogo" alt="afsf" width="250px"></a>
</div>
<!-- titre aligner -->
<h1 style="text-align: center;">Welcome to the home page!</h1>

<style>
	/* paramettre de style, inscris ici pour ne pas chercher les prioriter */
	h3,
	p {
		text-align: center;
	}

	#bootstrapcard,
	#btn {
		margin: 0 30% 0 30%;
		text-align: center;
	}

	.img-fluid {
		text-align: center;
	}
</style>

<!-- systeme de carte de la librairie bootstrap -->
<!-- en forme de tableau -->
<div id="bootstrapcard" class="row">
	<!-- premiere colonne -->
	<div class="col-sm-6">
		<!-- premiere carte -->
		<div class="card">
			<div class="card-body">
				<!-- titre -->
				<h3 class="card-title">User</h3>
				<!-- logo de la cart récuperer de ce dossier -->
				<img src="../img/img-01.png" class="img-fluid" height="75%">
				<p class="card-text">Modifications et Création des Users</p>
				<!-- lien une fois appuyer sur le bouton -->
				<a href="users/php/show.php" class="btn btn-danger">Go</a>
			</div>
		</div>
	</div>
	<!-- deuxieme carte de bootsrap -->
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">Presse</h3>
				<img src="../img/revue-de-presse.jpg" class="img-fluid" height="75%">
				<p class="card-text">Modifications et Création des articles.</p>
				<a href="presse/php/show.php" class="btn btn-danger">Go</a>
			</div>
		</div>
	</div>
</div>