
<?php
try{
	$pdo=new PDO("mysql:host=localhost;dbname=project","root","");
}
catch(PDOException $e){
	echo $e->getMessage();
}
?>


<?php
function pdo_connect_mysql()
{
	// Information de connection base de donnée
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	// nom de la base de donnée
	$DATABASE_NAME = 'project';
	// connection a la base de donnée
	try {
		return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
		echo 'connected';
	} catch (PDOException $exception) {
		// If there is an error with the connection, stop the script and display the error.
		exit('Failed to connect to database!');
	}
}

// fonction de l'html du module presse (backoffice)
function module_header($title)
{
	echo <<<EOT
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>$title</title>
		
		<!-- inclure la page de style et les liens pour les polices et logos -->
		<link href="../../../css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arimo" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
	<nav class="navtop">
	<div>
		<h1>Back Office </h1>
		<a href="../../home.php"><i class="fas fa-home"></i>Home</a>
		<a href="../../../../admin/modules/users/php/show.php"><i class="fas fa-address-book"></i>Utilisateurs</a>
		<a href="../../../../admin/modules/presse/php/show.php"><i class="fas fa-user-tie"></i>Flux Activité</a>
		<a href="../../deconnect.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
	</div>
</nav>
EOT;
}

function module_footer()
{
	echo <<<EOT
    </body>
</html>
EOT;
}

?>
