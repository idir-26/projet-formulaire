<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=profil;','root','');
if(!$_SESSION['admin'] AND !$_SESSION['mdp']){
    header('Location: connection.php');
}

if(isset($_POST['envoi'])){
    if(!empty($_POST['message'])){
        $pseudo = $_SESSION['pseudo'];
        $message = nl2br(htmlspecialchars($_POST['message']));
        $date = date('20y-m-d h:m:s');
        
        $insertMessage = $bdd->prepare('INSERT INTO messagerie(pseudo, message, date)VALUES(?, ?, ?)');
        $insertMessage->execute(array($pseudo, $message, $date));
        
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
		<h1>Messagerie</h1>
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
	   $recupPsMessage = $bdd->query('SELECT * FROM messagerie');
	   while($messagerie = $recupPsMessage->fetch()){
	       ?>
		   <table class="table table-success table-striped">
		   		<div class="container">
  					<div class="row">
  	  					<div class="col">
      						Column
    					</div>
    					<div class="col">
      						Column
   		 				</div>
    					<div class="col">
      						Column
    					</div>
  					</div>
				</div>
			</table>




	       <div class="messagerie" style="border: 1px solid black;">
		   		
	       		<h4 style="text-decoration:underline;"><?= $messagerie['pseudo'] ?>:   "<?= $messagerie['date']?></h4>
	       		<p><?= $messagerie['message'] ?> </p>
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