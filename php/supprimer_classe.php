<?php

//PAGE DE TRAITEMENT PERMETTANT DE SUPPRIMER UNE CLASSE D'UNE ECOLE

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

if(isset($_SESSION['idUser'])){
    $idSession = $_SESSION['idUser'];
}

//VARIABLES
$ref_classe = $_GET['idClasse'];
$ref_ecole = $_GET['refEcole'];
$ecoId = $_GET['idEcole'];


// REQUETE SQL POUR RECUPERER LES DROITS

$sql3 = "SELECT * FROM `droits` WHERE `dr_usrId`= '$idSession' AND `dr_ecoId` = '$ecoId' ";
$recipesStatement3 = $db->prepare($sql3);
$recipesStatement3->execute();
$row_cnt = $recipesStatement3->rowCount();


if($row_cnt>0){
    //REQUETE SQL POUR SUPPRIMER UNE CLASSE EN FONCTION DE LA REFERANCE DE LA CLASSE RECUPERER DANS LE LIEN EN GET
    $sql = "DELETE FROM `classe` WHERE `cl_id`='$ref_classe'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();
}

//REDIRIGER VERS ... 
$lien = "page_ecole.php?id=".$ref_ecole;
header('location: ' . $lien);


?>