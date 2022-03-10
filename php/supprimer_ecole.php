<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

$ref = $_GET['id'];

//RECUPERATION DE L'ID ECOLE
$sql = "SELECT eco_id FROM `ecole` WHERE eco_ref = '$ref'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);
$idEcole = $donnees['eco_id'];

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




header('location: dashboard.php');


?>