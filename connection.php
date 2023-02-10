<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=profil;','root','');
$recupUsers = $bdd->query('SELECT * FROM membres');


function verify_password($password, $salt, $hash) {
    $hashed_password = hash('sha256', $salt . $password);
    $password = [ 'hash' => $hash, 'salt' => $salt ];
    return $password['hash'] === $hash;
}


if (isset($_POST['valider'])){
    if(!empty($_POST['email']) AND !empty($_POST['mdp'])){
        $email_default = "admin@gmail.com";
        $mdp_default = "admin123";
        
        $email_saisi = htmlspecialchars($_POST['email']);
        $mdp_saisi = htmlspecialchars($_POST['mdp']);
        
        if($email_saisi == $email_default AND $mdp_saisi == $mdp_default){
            $_SESSION['admin'] = $mdp_saisi;
            $_SESSION['pseudo'] = $email_saisi;
            
            
            header('Location: accueil.php');
        }else 
        {
            while($user = $recupUsers->fetch()){
                if($email_saisi == $user['email'] ) //AND $mdp_saisi == $user['mdp'])
                {
                    $salt = $user['sel'];
                    $password = $mdp_saisi;
                    $hash = $user['mdp'];

                    //echo $salt;
                    //echo $password;
                    //echo $hash;
                    //echo verify_password($password, $salt, $hash);
                    if (verify_password($password, $salt, $hash)) {
                        // Mot de passe correct
                        echo "&&&";
                        $_SESSION['mdp'] = $mdp_saisi;
                        $_SESSION['pseudo'] = $user['pseudo'];
                        $_SESSION['id'] = $user['id'];
                        echo "ééé";

                        header('Location: accueil.php');
                    }
                }
            }
            echo "identifiant ou mot de passe incorrect";
        }
            
    }else {
        echo "faut completer tous les champs";
    }
}
?>
<!DOCTYPE html >
<html> 
<head>
	<title>Espace de connexion admin</title>
	<meta charset="utf-8">
</head>
<body>
	<header>
  <nav>
  <ul>
    <li><a href="inscription.php">Inscription</a></li>
  </ul>
  </nav>
</header>

	<form method="POST" action="">
		<div align=center>
			<br><br>
			<h1>Connection</h1>
			<br><br>
            
			<input type="email" name="email" placeholder="Entrer votre Email" 
                required pattern="^[A-Za-z]+@{1}[A-Za-z]+\.{1}[A-Za-z]{2,}$" />
            
			<br><br>
            
            
			<input type="password" name="mdp" placeholder="Votre mot de passe">
            
			<br><br>
			<input type="submit" name="valider" value="valider">
		</div>
	</form>
</body>
</html>