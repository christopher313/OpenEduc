<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

$ref = $_GET['id'];
$link = "droits.php?id=" . $ref;
$utilisateur_droit = $_POST['user_droit'];
$idCreator = $_SESSION['idUser'];

$sql = "SELECT * FROM `compte` WHERE `ct_username`= '$utilisateur_droit'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);

$idUser = $donnees['ct_id'];
$eco_id = $_POST['eco_id'];

echo "Nom utilisateur: " . $utilisateur_droit. "  idCreateur: " . $idCreator . " idUser: " . $idUser . " idEcole: " . $eco_id;

$sql = "INSERT INTO `droits`(`dr_creatorId`, `dr_usrId`, `dr_ecoId`) VALUES ( :creatorId, :usrId, :ecoId)";
$recipesStatement = $db->prepare($sql);
$exec = $recipesStatement->execute(array(":creatorId"=>$idCreator, ":usrId"=>$idUser, ":ecoId"=>$eco_id));

header('location: ' . $link );

?>