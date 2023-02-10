<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=profil;','root','');

if(isset($_POST['insc'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        
        $pseudo_saisi = htmlspecialchars($_POST['pseudo']);
        $email_saisi = htmlspecialchars($_POST['email']);
        $age_saisi = htmlspecialchars($_POST['age']);
        $mdp_saisi = htmlspecialchars($_POST['mdp']);
        
        function hash_password($password) {
  
          $hash = hash('sha256', $salt . $password); // concatène le sel et le mot de passe, puis hache le résultat
          return [ 'hash' => $hash, 'salt' => $salt ];
        }

        $salt = bin2hex(random_bytes(8)); // génère une chaîne aléatoire de sel
        $password = $mdp_saisi;
        $hashed_password = hash_password($password);
        $hashed_mdp = $hashed_password['hash'];

        
        $inscr = $bdd->prepare('INSERT INTO membres(pseudo, email, age, sel, mdp)VALUES(?, ?, ?, ?, ?)');
        $inscr->execute(array($pseudo_saisi, $email_saisi, $age_saisi, $salt, $hashed_mdp));
        
        header('Location: connection.php');
    }else 
    {
        echo "erreure d'inscription";
    }
}
?>
<html> 
<head>
	<title>Espace de connexion admin</title>
	<meta charset="utf-8">
</head>
<body>
<header>
  <nav>
  <ul>
    <li><a href="connection.php">connection</a></li>
  </ul>
  </nav>
</header>
	<form method="POST" action="">
		<div align="center">
			<br><br>
			<h1>Inscription</h1>
			<br><br>
			Prenom :<input type="text" name="pseudo" placeholder="Votre Prenom"
      required pattern="^[A-Za-z '-]+$" maxlength="20">
			<br><br>
      Age : <input type="number" name="age" min="12" max="99" placeholder="Entrer votre age" />
      <br><br>
      Email  : <input type="email" name="email" placeholder="Entrer votre Email" 
        required pattern="^[A-Za-z]+@{1}[A-Za-z]+\.{1}[A-Za-z]{2,}$" />
      <br><br>
			Mot de passe :<input type="password" name="mdp" placeholder="Votre mot de passe">
			<br><br>
			<input type="submit" name="insc" value="inscription">
		</div>
	</form>
</body>
</html>