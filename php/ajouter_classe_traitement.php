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
$ecoId = $_GET['id'];
$civilite = $_POST['civilite'];
$idSession = $_SESSION['idUser'];


//REQUETES SQL
$sql = "INSERT INTO `classe`(`cl_nomProf`, `cl_idEcole`, `cl_idNiveau`, `cl_effectif`, `cl_civilite`) VALUES (:nomProf, :idEcole, :niveau, :effectif, :civilite)";
$res = $db->prepare($sql);
$exec = $res->execute(array(":nomProf"=>$nomProf, ":idEcole"=>$ecoId, ":niveau"=>$niveau, ":effectif"=>$effectif, ":civilite"=>$civilite));

// AJOUTER A l'HISTORIQUE
$laDate = date('Y-m-d H:i:s');
$sqlHistorique = "INSERT INTO `modifications`(`mdf_idEcole`, `mdf_idUser`, `mdf_date`, `mdf_type`) VALUES (:idEcole, :idUser, :laDate, :typeModif)";
$res = $db->prepare($sqlHistorique);
$exec = $res->execute(array(":idEcole"=>$ecoId, ":idUser"=>$idSession, ":laDate"=>$laDate, ":typeModif"=>2));


$lien = "page_ecole.php?id=" . $ecoId ;

//REDIRECTION
header('location: ' . $lien );


?>
