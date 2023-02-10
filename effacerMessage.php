<?php
$bdd = new PDO('mysql:host=localhost;dbname=profil;','root','');
if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $recupMessage = $bdd->prepare('SELECT * FROM messagerie WHERE id = ?');
    $recupMessage->execute(array($getid));
    if($recupMessage->rowCount() > 0)
    {
        $suppMessage = $bdd->prepare('DELETE FROM messagerie WHERE id = ?');
        $suppMessage->execute(array($getid));
        header('Location: messagerie.php');
    }else
    {
        echo "Message inexistant!!";
    }
}else 
{
    "Aucun id";
}
?>