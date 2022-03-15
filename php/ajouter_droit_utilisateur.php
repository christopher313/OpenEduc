<?php

//PAGE DE TRAITEMENT POUR AJOUTER LES DROITS UTILISATEURS 

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";


//VARIABLES
$ref = $_GET['id'];
$link = "droits.php?id=" . $ref;
$utilisateur_droit = $_POST['user_droit'];
$idCreator = $_SESSION['idUser'];

//REQUETE SQL POUR RECUPERER L'ID UTILISATEUR A PARTIR DE SON NOM D'UTILISATEUR
$sql = "SELECT * FROM `compte` WHERE `ct_username`= '$utilisateur_droit'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);

//VARIABLES
$idUser = $donnees['ct_id'];
$eco_id = $_POST['eco_id'];

//REQUETE SQL POUR INSERER LE NOUVEAU DROIT UTILISATEUR
$sql = "INSERT INTO `droits`(`dr_creatorId`, `dr_usrId`, `dr_ecoId`) VALUES ( :creatorId, :usrId, :ecoId)";
$recipesStatement = $db->prepare($sql);
$exec = $recipesStatement->execute(array(":creatorId"=>$idCreator, ":usrId"=>$idUser, ":ecoId"=>$eco_id));


//REDIRECTION 
header('location: ' . $link );

?>