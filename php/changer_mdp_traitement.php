<?php


require "navmenu.php";

$mdp = $_POST['mdp'];

if(isset($_SESSION['idUser'])){
    $idSession = $_SESSION['idUser'];
}


$sql = "UPDATE `compte` SET `ct_password`= '$mdp' WHERE `ct_id`= '$idSession';";
$recipesStatement = $db->prepare($sql);
$exec = $recipesStatement->execute();


header("location: accueil.php");


?>