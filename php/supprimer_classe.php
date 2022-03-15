<?php

//PAGE DE TRAITEMENT PERMETTANT DE SUPPRIMER UNE CLASSE D'UNE ECOLE

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";


//VARIABLES
$ref_classe = $_GET['idClasse'];
$ref_ecole = $_GET['idEcole'];



//REQUETE SQL POUR SUPPRIMER UNE CLASSE EN FONCTION DE LA REFERANCE DE LA CLASSE RECUPERER DANS LE LIEN EN GET
$sql = "DELETE FROM `classe` WHERE `cl_id`='$ref_classe'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();


//REDIRIGER VERS ... 
$lien = "page_ecole.php?id=".$ref_ecole;
header('location: ' . $lien);


?>