<?php

//PAGE PERMETTANT L'AJOUT D'UNE CLASSE DANS LA BASE DE DONNEES 

//INITIALISATION
include("database.php");
session_start();
require "navmenu.php";


//VARIABLES
$niveau = $_POST['classes'];
$nomProf = $_POST['nom_prof'];
$effectif = $_POST['effectif'];
$idEcole = $_POST['idEcole'];
$civilite = $_POST['civilite'];


//REQUETES SQL
$sql = "INSERT INTO `classe`(`cl_nomProf`, `cl_idEcole`, `cl_idNiveau`, `cl_effectif`, `cl_civilite`) VALUES (:nomProf, :idEcole, :niveau, :effectif, :civilite)";
$res = $db->prepare($sql);
$exec = $res->execute(array(":nomProf"=>$nomProf, ":idEcole"=>$idEcole, ":niveau"=>$niveau, ":effectif"=>$effectif, ":civilite"=>$civilite));


$ref = $_GET['id'];
$lien = "page_ecole.php?id=" . $ref ;

//REDIRECTION
header('location: ' . $lien );


?>
