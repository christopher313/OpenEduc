<?php

//PAGE DE TRAITEMENT POUR SUPPRIMER UNE ECOLE EN FONCTION DE LA REFERANCE DE L'ECOLE

//INITIALISATION DE LA PAGE

require "navmenu.php";

//VARIABLE
$ecoId = $_GET['id'];


//RECUPERATION DE L'ID ECOLE
$sql = "SELECT * FROM ecole INNER JOIN droits ON ecole.eco_id = droits.dr_ecoId WHERE `eco_id`= '$ecoId'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);
$creatorId = $donnees['dr_creatorId'];


echo $creatorId . " / " . $_SESSION['idUser'];

if($creatorId == $_SESSION['idUser']){

    //SUPPRESSION DE L'ECOLE 
    $sql = "DELETE FROM `ecole` WHERE `eco_id`='$ecoId'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();

    //SUPPRESSION DES DROITS 
    $sql = "SELECT * FROM `droits` WHERE dr_ecoId = '$ecoId'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();

    //SUPPRESSION DES CLASSES

    $sql = "DELETE FROM `classe` WHERE `cl_idEcole`='$ecoId'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();

}




header('location: dashboard.php');


?>