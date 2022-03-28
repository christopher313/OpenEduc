<?php

//PAGE DE TRAITEMENT POUR SUPPRIMER UNE ECOLE EN FONCTION DE LA REFERANCE DE L'ECOLE

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

//VARIABLE
$ref = $_GET['id'];


//RECUPERATION DE L'ID ECOLE
$sql = "SELECT * FROM ecole INNER JOIN droits ON ecole.eco_id = droits.dr_ecoId WHERE `eco_ref`= '$ref'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);
$idEcole = $donnees['eco_id'];
$creatorId = $donnees['dr_creatorId'];


echo $creatorId . " / " . $_SESSION['idUser'];

if($creatorId == $_SESSION['idUser']){

    //SUPPRESSION DE L'ECOLE 
    $sql = "DELETE FROM `ecole` WHERE `eco_id`='$idEcole'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();

    //SUPPRESSION DES DROITS 
    $sql = "SELECT * FROM `droits` WHERE dr_ecoId = '$idEcole'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();

    //SUPPRESSION DES CLASSES

    $sql = "DELETE FROM `classe` WHERE `cl_idEcole`='$idEcole'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();

}




header('location: dashboard.php');


?>