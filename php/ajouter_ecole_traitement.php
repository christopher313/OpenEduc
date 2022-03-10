<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

if($_SESSION['role'] == 1 || 2){?>

<?php
}
else{
    header("location:index.php");
}

$nom = $_POST['school_name'];
$nom = strtoupper($nom);
$ref = $_POST['school_ref'];
$adresse = $_POST['school_adresse'];
$cp = $_POST['school_cp'];
$ville = $_POST['school_city'];
$mail = $_POST['school_mail'];
$tel = $_POST['school_number'];
$lien = $ref . ".php";
$idUser = $_SESSION['idUser'];
$idCreateur = $idUser;



$sql = "INSERT INTO `ecole`(`eco_nom`, `eco_ref`, `eco_adresse`, `eco_cp`, `eco_ville`, `eco_mail`, `eco_tel`, `eco_lien`) VALUES (:nom , :ref, :adresse, :cp, :ville, :mail, :tel, :lien) ";



$res = $db->prepare($sql);
$exec = $res->execute(array(":nom"=>$nom, ":ref"=>$ref, ":adresse"=>$adresse, ":cp"=>$cp, ":ville"=>$ville, ":mail"=>$mail, ":tel"=>$tel, ":lien"=>$lien));
$last_id = $db->lastInsertId();

if($exec){
    echo "Insertion réussie";
    $sql = "INSERT INTO `droits`(`dr_creatorId`, `dr_usrId`, `dr_ecoId`) VALUES (:idCreateur, :idUtilisateur, :idEcole)";
    $res = $db->prepare($sql);
    $exec = $res->execute(array(":idCreateur"=>$idCreateur, ":idUtilisateur"=>$idUser, ":idEcole"=>$last_id));
    echo $idUser ."et " . $last_id;
    header('location: dashboard.php');
}
else{
    echo "Insertion echoué";
}

?>