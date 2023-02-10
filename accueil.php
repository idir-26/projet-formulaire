<?php
session_start();
if(!$_SESSION['admin'] AND !$_SESSION['mdp']){
    header('Location: connection.php');
}  
$pseudo = $_SESSION['pseudo'];
echo $pseudo;
?>

<!DOCTYPE html >
<html> 
<head>
	<title>Home</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<h1>Accueil</h1>
	</div>
	<header>
  <nav>
  <ul>
    <li><a href="deconnection.php">Déconnexion</a>
    	<h4><?= "utilisateur: ",$pseudo ?></h4>
    </li>
  </ul>
  </nav>
</header>
	<a href="users.php">Les membres</a>
	<a href="messagerie.php">messagerie</a>
</body>
</html>
