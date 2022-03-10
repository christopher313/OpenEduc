<?php


include("database.php");
session_start();
require "navmenu.php";



$niveau = $_POST['classes'];
$nomProf = $_POST['nom_prof'];
$effectif = $_POST['effectif'];
$idEcole = $_POST['idEcole'];
$civilite = $_POST['civilite'];

echo $niveau . $nomProf . $effectif . $idEcole;

$sql = "INSERT INTO `classe`(`cl_nomProf`, `cl_idEcole`, `cl_idNiveau`, `cl_effectif`, `cl_civilite`) VALUES (:nomProf, :idEcole, :niveau, :effectif, :civilite)";
$res = $db->prepare($sql);
$exec = $res->execute(array(":nomProf"=>$nomProf, ":idEcole"=>$idEcole, ":niveau"=>$niveau, ":effectif"=>$effectif, ":civilite"=>$civilite));


$ref = $_GET['id'];
$lien = "page_ecole.php?id=" . $ref ;
header('location: ' . $lien );


?>
