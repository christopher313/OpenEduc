<?php

//PAGE DE TRAITEMENT POUR SUPPRIMER LES DROITS LIE A L'UTILISATEUR

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

//VARIABLES
$ref_droit = $_GET['idDroit'];
$ref_ecole = $_GET['idEcole'];


//REQUETE SQL POUR SUPPRIMER LES DROITS PAR RAPPORT A LA REFERANCE DU DROIT AVEC LE LIEN EN GET
$sql = "DELETE FROM `droits` WHERE `dr_id`='$ref_droit'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();



//REDIRECTION VERS ... 
$lien = "droits.php?id=".$ref_ecole;
header('location: ' . $lien);


?>