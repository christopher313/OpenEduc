<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

$ref_droit = $_GET['idDroit'];
$ref_ecole = $_GET['idEcole'];




//SUPPRESSION DES DROITS
/*
$sql = "SELECT * FROM `ecole` WHERE `eco_ref`= '$ref_ecole'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);

$idEcole = $donnees['eco_id'];
*/


$sql = "DELETE FROM `droits` WHERE `dr_id`='$ref_droit'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();




$lien = "droits.php?id=".$ref_ecole;

header('location: ' . $lien);


?>