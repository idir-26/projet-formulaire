<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=profil;','root','');
if(!$_SESSION['admin'] AND !$_SESSION['mdp']){
    header('Location: connection.php');
}
$Id = $_SESSION['id'];
echo $Id;

if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
}
echo $getid;
$idR = $getid * 1000 + $Id * 10;

if(isset($_POST['envoi'])){
    if(!empty($_POST['message'])){
        $pseudo = $_SESSION['pseudo'];
        $message = nl2br(htmlspecialchars($_POST['message']));
        
        //$recupIdM = $bdd->query('SELECT * FROM membres');
        //$IdM = $recupIdM->fetch();
        
        $IdM = $Id * 1000 + $getid * 10;
        
        $date = date('20y-m-d h:m:s');
        
        $insertMessage = $bdd->prepare('INSERT INTO discuter(pseudo_d, msg_d, id_msg, date_d)VALUES(?, ?, ?, ?)');
        $insertMessage->execute(array($pseudo, $message, $IdM, $date));
        
        echo "message envoyé";
    }else
    {
        echo "erreure d'envoie";
    }
}

?>
<!DOCTYPE html >
<html> 
<head>
	<title>Messagerie</title>
	<meta charset="utf-8">
</head>
<body>
	<div align="center">
		<h1>Messagerie privée</h1>
	</div>
	
	<header>
  <nav>
  <ul>
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="deconnection.php">Déconnexion</a></li>
  </ul>
  </nav>
</header>
	<?php 
	   $recupPsMessage = $bdd->query('SELECT * FROM discuter ');
	   //$recupPsMessage->execute(array($IdM));
	   while($messagerie = $recupPsMessage->fetch()){
	       if($messagerie['id_msg'] == $IdM OR $messagerie['id_msg'] == $idR){
	           
	           ?>
	       <div class="messagerie" style="border: 1px solid black;">
	       		<h4 style="text-decoration:underline;"><?= $messagerie['pseudo_d'] ?>: <?= $messagerie['date_d'] ?></h4>
	       		<p><?= $messagerie['msg_d'] ?> </p>
	       		<div align="right">
	       		<?php 
	       		if($_SESSION['admin']){
	       		    ?>
	       		    <a href="effacerMessage.php?id=<?= $messagerie['id']; ?>">
	       			<button style="color:white; background-color:red; margin-bottom:1px;">Effacer</button>
	       		</a>
	       		<?php 
	       		}
	       		
	       		?>
	       		
	       		</div>
	       </div>
	       <br>
	       <?php 
	           
	       } 
	   }
	
	?>
</body>
<body>
	<form method="POST" action="">
		<br><br>
		<div align="center">
		<textarea name="message" placeholder="Votre message"></textarea>
		<br><br>
		<input type="submit" name="envoi">
		<br><br>	
		</div>
	</form>
</body>
</html>