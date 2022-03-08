<?php


include("database.php");
session_start();
require "navmenu.php";



$niveau = $_POST['classes'];
$nomProf = $_POST['nom_prof'];
$effectif = $_POST['effectif'];
$idEcole = $_POST['idEcole'];

echo $niveau . $nomProf . $effectif . $idEcole;

$sql = "INSERT INTO `classe`(`cl_nomProf`, `cl_idEcole`, `cl_idNiveau`, `cl_effectif`) VALUES (:nomProf, :idEcole, :niveau, :effectif)";
$res = $db->prepare($sql);
$exec = $res->execute(array(":nomProf"=>$nomProf, ":idEcole"=>$idEcole, ":niveau"=>$niveau, ":effectif"=>$effectif));


?>
