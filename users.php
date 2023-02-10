<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=profil;','root','');
if(!$_SESSION['mdp'] AND !$_SESSION['admin']){
    header('Location: connection.php');
}
?>

<!DOCTYPE html >
<html> 
<head>
	<title>Afficher les membres</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<h1>Membres</h1>
	</div>
	<header>
  <nav>
  <ul>
    <li><a href="accueil.php">Accueil</a></li>
  </ul>
  </nav>
</header>
	<?php 
	   $recupUsers = $bdd->query('SELECT * FROM membres');
	   while($user = $recupUsers->fetch()){
	       ?>
	       <p> <?= $user['pseudo']; ?><a href="privat.php?id=<?= $user['id']; ?>"><button style="color:blue; background-color:white; margin-bottom:1px;">discuter</button></a> 
	       
	       <?php 
	       		if($_SESSION['admin']){
	       		    ?>
	       		    <a href="supprimerUser.php?id=<?= $user['id']; ?>" style="color:red;text-decoration: none;"> Supprimer</a>
	       		<?php 
	       		}
	       		?>
	       </p>
	       <?php  
	   }
	?>
</body>
</html>
