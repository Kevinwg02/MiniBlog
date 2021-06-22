<!-- template utiliser -->
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="Frontoffice/css/LoginStyle.css">
</head>

<body>

	<section>
		<!-- systeme de connection login -->
		<?php
		// demarre la session
		session_start();
		// informations utilisateur a prendre
		@$login = $_POST["login"];
		@$pass = md5($_POST["pass"]);
		@$valider = $_POST["valider"];
		$erreur = "nope";
		// pour savoir qui sont les utilisateurs
		if (isset($valider)) {
			// inclure le fichier ou ce trouve informations de connection a la base de donnée 
			include("backoffice/admin/modules/connect.php");
			//    requette SQL mise dans une requette PDO et dans une variable
			$sel = $pdo->prepare("select * from utilisateurs where login=? and pass=? limit 1");
			//    compare le login et le mdp
			$sel->execute(array($login, $pass));
			$tab = $sel->fetchAll();

			if (count($tab) > 0) {
				$_SESSION["prenomNom"] = ucfirst(strtolower($tab[0]["prenom"])) .
					" " . strtoupper($tab[0]["nom"]);
				//  si autoriser envoies vers cette page
				$_SESSION["autoriser"] = "oui";
				if ($tab[0]["Grade"] === "Admin") {
					//   page si autoriser
					header("location: backoffice/admin/modules/home.php");
				}
			} else
				//    si mauvais mots de passe variable avec message 
				echo '<script>alert("access denied")</script>';
		}
		?>
	</section>
	<section class="LoginBox" action="" method="post">
		<span> <i class="fas fa-user-shield"></i></span>
		<form method="post" class="container">
			<a href="index.php"><h1>Login</h1></a>
				<br>
			<input class="login" placeholder="Login" name="login" required></input>

			<input class="password" type="password" placeholder="password" name="pass" required> </input>
			<br>
			<button class="loginbtn" name="valider" type="submit">Login </button>
		</form>
	</section>
</body>

</html>