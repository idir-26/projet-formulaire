<?php
session_start();
if(!$_SESSION['admin']){
    header('Location: users.php');
}
$bdd = new PDO('mysql:host=localhost;dbname=profil;','root','');

if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() > 0){
        $suppUser = $bdd->prepare('DELETE FROM membres WHERE id = ?');
        $suppUser->execute(array($getid));
        
        header('Location: users.php');
    }else 
    {
        echo "aucun membre n'a été trouvé";
    }
}else 
{
    echo "L'identifiant n'a pas été récupéré";
}
?>