<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

$ref_classe = $_GET['idClasse'];
$ref_ecole = $_GET['idEcole'];



//SUPPRESSION DES CLASSES

$sql = "DELETE FROM `classe` WHERE `cl_id`='$ref_classe'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();



$lien = "page_ecole.php?id=".$ref_ecole;

header('location: ' . $lien);


?>